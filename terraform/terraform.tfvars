s3_buckets = {
  "taskbucket" = {
    versioning_enabled = true
    force_destroy      = false
  }
}

tags = {
  Environment = "dev"
  Project     = "ssk"
}


