terraform {
  required_version = "1.14.4"

  required_providers {
    aws = {
      version = "4.29.0"
      source  = "hashicorp/aws"
    }
  }
}
