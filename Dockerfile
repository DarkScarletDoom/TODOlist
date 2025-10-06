FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Очистка кеша
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка расширений PHP
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создание рабочей директории
WORKDIR /var/www/html

# Копирование файлов проекта
COPY . .

# Установка прав
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap/cache

# Установка зависимостей Composer
RUN composer i

RUN cp .env.docker .env

# Генерация ключа приложения
RUN php artisan key:generate

# Обновление пакетов и установка Node.js и npm
RUN apt-get update && apt-get install -y \
    nodejs \
    npm

# Установка зависимостей npm
RUN npm install

# сборка
RUN npm run build
