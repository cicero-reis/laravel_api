# Identidade do domínio
resource "aws_ses_domain_identity" "mail_domain" {
  domain = var.ses_domain
}

# DKIM (opcional para testes)
resource "aws_ses_domain_dkim" "mail_dkim" {
  domain = aws_ses_domain_identity.mail_domain.domain
}

# Identidade de e-mail do remetente
resource "aws_ses_email_identity" "from_email" {
  email = var.ses_from_email
}
