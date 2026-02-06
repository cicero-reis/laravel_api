#!/usr/bin/env bash

set -e

echo "🔍 Iniciando análise SonarQube - Laravel API"
echo "📁 Projeto: $(pwd)"

docker run --rm \
  --network laravel_network \
  -e SONAR_HOST_URL="http://sonarqube:9000" \
  -e SONAR_LOGIN="sqp_24af758c037f0793fec122d8e7a1e01f3ade7270" \
  -v "$(pwd):/usr/src" \
  sonarsource/sonar-scanner-cli \
  -Dsonar.projectKey=laravel_api \
  -Dsonar.projectName="Laravel API" \
  -Dsonar.sources=app,routes \
  -Dsonar.language=php \
  -Dsonar.sourceEncoding=UTF-8
