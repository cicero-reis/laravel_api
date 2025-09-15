# ID da API
output "users_api_id" {
  description = "ID da API Gateway Users"
  value       = aws_api_gateway_rest_api.users_api.id
}

# URL base de invocação
output "users_api_url" {
  description = "URL para invocar a API Gateway (stage dev)"
  value       = "http://localhost:4566/restapis/${aws_api_gateway_rest_api.users_api.id}/dev/_user_request_"
}
