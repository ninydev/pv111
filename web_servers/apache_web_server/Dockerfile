# Используем базовый образ с Apache
FROM httpd:2.4

# Устанавливаем пакеты, которые могут понадобиться для настройки
RUN apt-get update \
    && apt-get upgrade -y

# Копируем наш кастомный конфиг Apache внутрь контейнера
COPY ./apache-config/httpd.conf /usr/local/apache2/conf/httpd.conf


# Создаем директорию для монтирования DocumentRoot
RUN mkdir -p /var/www/html
RUN mkdir -p /var/log/httpd

# Указываем рабочую директорию
WORKDIR /var/www/html

# Копируем содержимое DocumentRoot внутрь контейнера
COPY ./html/ .

# Устанавливаем права доступа
RUN chown -R www-data:www-data /var/www/html

# Открываем порт 80 для HTTP
EXPOSE 81

# Запускаем Apache при старте контейнера
CMD ["httpd-foreground"]
