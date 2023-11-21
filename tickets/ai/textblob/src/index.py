import pika
from dotenv import load_dotenv
import os

print('Start build')

# Загрузка переменных из файла .env
load_dotenv()

# Получение данных для подключения к RabbitMQ из переменных окружения
rabbitmq_user = os.getenv('RABBITMQ_DEFAULT_USER')
rabbitmq_pass = os.getenv('RABBITMQ_DEFAULT_PASS')
rabbitmq_server = os.getenv('RABBITMQ_SERVER')
rabbitmq_queue_text_blob = os.getenv('RABBITMQ_QUEUE_TEXT_BLOB')
rabbitmq_queue_notifications = os.getenv('RABBITMQ_QUEUE_NOTIFICATIONS')

rabbitmq_port = int(os.getenv('RABBITMQ_PORT', 5672))  # По умолчанию используется порт 5672

def callback(ch, method, properties, body):
    # Обработка полученного сообщения
    print(f"Received message: {body.decode()}")

# Подключение к RabbitMQ
credentials = pika.PlainCredentials(rabbitmq_user, rabbitmq_pass)
parameters = pika.ConnectionParameters(rabbitmq_server, rabbitmq_port, '/', credentials)
connection = pika.BlockingConnection(parameters)
channel = connection.channel()

# Объявление очереди, из которой будем получать сообщения
channel.queue_declare(queue=rabbitmq_queue_text_blob)

# Установка функции обратного вызова (callback) для обработки сообщений
channel.basic_consume(queue=rabbitmq_queue_text_blob, on_message_callback=callback, auto_ack=True)

print('Waiting for messages. To exit press CTRL+C')
# Запуск бесконечного цикла ожидания сообщений
channel.start_consuming()
