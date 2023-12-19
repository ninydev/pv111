# Базовый контейнер - чистая ОС
FROM ubuntu:22.04

# Основая папка где я сложу свой проект
WORKDIR /var/www/html

# TimeZone
ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Обновить версии пакетов
RUN apt update && apt upgrade -y

# Установим вспомогательное ПО
RUN apt install -y curl ca-certificates zip unzip git mc gnupg gosu

# Установить версию php
RUN curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list


RUN apt update && apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-curl

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Загрузим код проекта в контейнер
COPY ./src .

# Уставноим веб сервер
RUN apt install -y nginx

# Копируем наш кастомный конфиг Nginx внутрь контейнера
COPY ./nginx.conf /etc/nginx/nginx.conf

# Установка и конфигурация утилиты автозапуска supervisor
RUN apt install -y supervisor

# Копирование конфигурационного файла supervisord для воркеров очереди
COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Запуск сервисов контейнера
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Запуск теперь я произвожу с помощью SuperVisor - и там описываю правила для приложений
# CMD service php8.2-fpm start && nginx -g "daemon off;"
