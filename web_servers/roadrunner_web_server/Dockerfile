FROM ghcr.io/roadrunner-server/roadrunner:latest AS roadrunner
FROM php:8.2-cli

COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr

# Install and configure your application
# ...

COPY ./roadrunner-config/.rr.yaml /etc/.rr.yaml


# Устанавливаем RoadRunner через composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer global require spiral/roadrunner

# Определяем рабочую директорию
WORKDIR /var/www/html

# Копируем код приложения
COPY ./html /var/www/html

EXPOSE 80

CMD rr serve -c /etc/.rr.yaml
