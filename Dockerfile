# 使用官方的 PHP 映像作為基礎映像
FROM php:8.1-apache

# 安裝 mysqli 擴展
RUN docker-php-ext-install mysqli

# 複製當前目錄的所有檔案到容器中的 /var/www/html 目錄
COPY . /var/www/html/

# 允許 Apache 使用 .htaccess
RUN a2enmod rewrite

# 暴露容器的80端口
EXPOSE 80
