FROM php:8.2.28-cli

# Argumentos de usuário
# Criar usuário com o mesmo UID e GID do host
ARG HOST_UID=1001
ARG HOST_GID=1001
ARG USERNAME=creis

# Diretório de trabalho
WORKDIR /application

# Variáveis de ambiente
ENV TZ=America/Sao_Paulo

# Instalar dependências do sistema e extensões PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    tzdata \
    vim \
    supervisor \
    procps \
    net-tools \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configurar timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Instalar Xdebug (opcional)
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Configuração customizada do PHP
RUN echo "display_errors=On" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "log_errors=On" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "error_log=/var/log/php_errors.log" >> /usr/local/etc/php/conf.d/custom.ini \
    && mkdir -p /var/log && touch /var/log/php_errors.log && chmod 777 /var/log/php_errors.log

# Instalar extensões adicionais (MongoDB, Redis)
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Instalar Node.js (para Vite e outras dependências JS)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Instalar npm e dependências do Node.js
RUN npm install -g chokidar

# Copiar Composer da imagem oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar RoadRunner (binário oficial)
RUN curl -Ls https://github.com/roadrunner-server/roadrunner/releases/latest/download/roadrunner-linux-amd64 \
    -o /usr/local/bin/rr \
    && chmod +x /usr/local/bin/rr

RUN groupadd -g ${HOST_GID} ${USERNAME} \
    && useradd -m -u ${HOST_UID} -g ${HOST_GID} -s /bin/bash ${USERNAME} \
    && chown -R ${USERNAME}:${USERNAME} /application \
    && chmod -R 775 /application

# Copiar configurações customizadas do PHP
COPY php.ini /usr/local/etc/php/php.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Copiar configuração do Supervisor
COPY supervisor.conf /etc/supervisor/conf.d/supervisord.conf

# Copiar configuração do RoadRunner
COPY .rr.yaml /application/.rr.yaml

# Expor a porta do RoadRunner
EXPOSE 8080

# Iniciar Supervisor, que irá iniciar o RoadRunner
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
