

const mixImages = async (fakeImage) => {

    // Операция по микшированию 2 изображений тут
    console.log(fakeImage);
}

/**
 * Configure RabbitMQ server
 */
const RABBITMQ_DEFAULT_USER = process.env.RABBITMQ_DEFAULT_USER || 'root';
const RABBITMQ_DEFAULT_PASS = process.env.RABBITMQ_DEFAULT_PASS || 'password';
const RABBITMQ_SERVER = process.env.RABBITMQ_SERVER || 'rabbit.mq';
const RABBITMQ_PORT = process.env.RABBITMQ_PORT || 5672;
const RABBITMQ_CONNECTION_URI = `amqp://${RABBITMQ_DEFAULT_USER}:${RABBITMQ_DEFAULT_PASS}@${RABBITMQ_SERVER}:${RABBITMQ_PORT}`;

const RABBITMQ_QUEUE_MIX = process.env.RABBITMQ_QUEUE_MIX || 'jobs.mix.images';


const amqp = require ('amqplib/callback_api.js');

let connection;
let channel;

// Шаг 1 - соединение с брокером обмена сообщениями
// - тут создается соединение по Сокету (на порт RabbitMQ) и далее это соединение остается открытым постоянно
amqp.connect(RABBITMQ_CONNECTION_URI, {}, async (errorConnect, conn) => {
    if (errorConnect) {
        console.error(errorConnect);
        process.exit(-1);
    }

    connection = conn;
    console.debug("connect RabbitMQ ok");

    // Шаг 2 - Создание канала связи
    // Канал связи - используется для приема и передачи данных на сервер
    // Поскольку в одном приложении мы можем использовать большое количество разных сообщений
    // Для каждого лучше использовать отдельный канал приема передачи
    // Тогда в одном соединении можно использовать много каналов
    await connection.createChannel(async (errorChannel, ch) => {
        if (errorChannel) {
            console.error(errorChannel);
            process.exit(-1);
        }


        // Шаг 3 - Ассоциация (назначение) очереди для этих сообщений
        // Мы настраиваем соединение с очередью - настраиваем правила доставки сообщений, режим хранения и тд
        await ch.assertQueue(RABBITMQ_QUEUE_MIX, {}, (errorQueue) => {
            if (errorQueue) {
                console.error(errorQueue);
                process.exit(-1);
            }
            console.debug("Mix queue asserted");
        });

        channel = ch;
    });


});


module.exports = (fakeImage) => {
    channel.sendToQueue (RABBITMQ_QUEUE_MIX, Buffer.from(JSON.stringify(fakeImage)));
};





