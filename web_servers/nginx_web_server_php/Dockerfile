# Используем базовый образ с Nginx
FROM nginx:latest

# Устанавливаем пакеты, которые могут понадобиться для настройки
RUN apt-get update \
    && apt-get install -y \
    php mc php8.2-fpm

# Копируем наш кастомный конфиг Nginx внутрь контейнера
COPY ./nginx-config/nginx.conf /etc/nginx/nginx.conf

# Создаем директорию для монтирования DocumentRoot
RUN mkdir -p /usr/share/nginx/html

# Указываем рабочую директорию
WORKDIR /usr/share/nginx/html

# Копируем содержимое DocumentRoot внутрь контейнера
COPY ./html/ .

# Устанавливаем права доступа
RUN chown -R nginx:nginx /usr/share/nginx/html

# Открываем порт 80 для HTTP
EXPOSE 80

# Запускаем Nginx при старте контейнера
#CMD ["service", "php8.2-fpm", "start"]
#CMD ["nginx", "-g", "daemon off;"]
CMD service php8.2-fpm start && nginx -g "daemon off;"

