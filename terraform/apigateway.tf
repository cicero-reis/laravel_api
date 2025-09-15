resource "aws_api_gateway_rest_api" "users_api" {
  name        = "users-api"
  description = "API Gateway REST para usuários"
}

# /users
resource "aws_api_gateway_resource" "users_resource" {
  rest_api_id = aws_api_gateway_rest_api.users_api.id
  parent_id   = aws_api_gateway_rest_api.users_api.root_resource_id
  path_part   = "users"
}

# /users/{proxy+}
resource "aws_api_gateway_resource" "users_proxy" {
  rest_api_id = aws_api_gateway_rest_api.users_api.id
  parent_id   = aws_api_gateway_resource.users_resource.id
  path_part   = "{proxy+}"
}

# Método base /users
resource "aws_api_gateway_method" "users_method" {
  rest_api_id   = aws_api_gateway_rest_api.users_api.id
  resource_id   = aws_api_gateway_resource.users_resource.id
  http_method   = "ANY"
  authorization = "NONE"
}

# Método proxy /users/{proxy+}
resource "aws_api_gateway_method" "proxy_method" {
  rest_api_id   = aws_api_gateway_rest_api.users_api.id
  resource_id   = aws_api_gateway_resource.users_proxy.id
  http_method   = "ANY"
  authorization = "NONE"

  request_parameters = {
    "method.request.path.proxy" = true
  }
}

# Integração base /users
resource "aws_api_gateway_integration" "users_integration" {
  rest_api_id             = aws_api_gateway_rest_api.users_api.id
  resource_id             = aws_api_gateway_resource.users_resource.id
  http_method             = aws_api_gateway_method.users_method.http_method
  integration_http_method = "ANY"
  type                    = "HTTP_PROXY"
  uri                     = var.aws_api_gateway_integration_uri
}

# Integração proxy /users/{proxy+}
resource "aws_api_gateway_integration" "proxy_integration" {
  rest_api_id             = aws_api_gateway_rest_api.users_api.id
  resource_id             = aws_api_gateway_resource.users_proxy.id
  http_method             = aws_api_gateway_method.proxy_method.http_method
  integration_http_method = "ANY"
  type                    = "HTTP_PROXY"
  uri                     = "http://host.docker.internal:8001/api/users/{proxy}"

  request_parameters = {
    "integration.request.path.proxy" = "method.request.path.proxy"
  }
}

# Deployment (sempre recriado quando algo muda)
resource "aws_api_gateway_deployment" "users_deployment" {
  depends_on = [
    aws_api_gateway_integration.users_integration,
    aws_api_gateway_integration.proxy_integration
  ]

  rest_api_id = aws_api_gateway_rest_api.users_api.id
  stage_name  = "dev"

  lifecycle {
    create_before_destroy = true
  }

  triggers = {
    redeployment = sha1(jsonencode([
      aws_api_gateway_integration.users_integration.id,
      aws_api_gateway_integration.proxy_integration.id
    ]))
  }
}
