variable "region" {
  description = "Indicates the AWS Region"
  type        = string
  default     = "us-east-1"
}

variable "localstack" {
  description = "Endpoint localstack"
  type        = string
  default     = "http://localhost:4566"
}

variable "access_key" {
  description = "AWS access_key"
  type        = string
  default     = "test"
}

variable "secret_key" {
  description = "AWS secret_key"
  type        = string
  default     = "test"
}

variable "s3_buckets" {
  description = "Lista de buckets S3 e suas configurações"
  type = map(object({
    versioning_enabled = bool
    force_destroy      = bool
  }))
}

variable "task_queue" {
  description = "SSK Queue"
  type        = string
  default     = "task_queue"
}

variable "task_queue_dlq" {
  description = "SSK Queue DLQ"
  type        = string
  default     = "ssk_dlq"
}

variable "ses_domain" {
  description = "Domínio usado para SES"
  type        = string
  default     = "local.dev"
}

variable "ses_from_email" {
  description = "Endereço de e-mail do remetente SES"
  type        = string
  default     = "nao-responda@local.dev"
}


variable "cloudwatch_log_group_name" {
  description = "Nome do CloudWatch Log Group"
  type        = string
  default     = "task_log_group"
}

variable "cloudwatch_log_stream_name" {
  description = "Nome do CloudWatch Log Stream"
  type        = string
  default     = "task_log_stream"
}

variable "tags" {
  description = "Tags to set..."
  type        = map(string)
  default     = {}
}

variable "aws_api_gateway_integration_uri" {
  description = "URI para integração do API Gateway"
  type        = string
  default     = "http://host.docker.internal:8001/api/users"
}

variable "aws_api_gateway_integration_uri_proxy" {
  description = "URI para integração do API Gateway com proxy"
  type        = string
  default     = "http://host.docker.internal:8001/api/users/{proxy}"
}

variable "stage_name" {
  description = "Stage da API Gateway (ex: dev, staging, prod)"
  type        = string
  default     = "dev" # dev, staging, prod
}

