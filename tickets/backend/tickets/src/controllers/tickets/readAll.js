
let ticketsFromDB = require('./data')



const REDIS_CACHE_HOST = process.env.REDIS_CACHE_HOST || 'redis.sockets';
const REDIS_CACHE_PORT = process.env.REDIS_CACHE_PORT || 6379;
const REDIS_CACHE_CONNECTION_STRING = `redis://${REDIS_CACHE_HOST}:${REDIS_CACHE_PORT}`;

const redis = require('redis');
const {createClient} = require("redis");
const redisClient = createClient({
    url: REDIS_CACHE_CONNECTION_STRING});

redisClient.connect()
    .then(() => {console.log('cache Redis Connect')})
    .catch((err) => {
        console.log(err)
    })

// Подключение к Redis серверу
redisClient.on('connect', () => {
    console.log('Connected to Cache Redis Server');
});

// Обработка ошибок подключения
redisClient.on('error', (err) => {
    console.error(`Error: ${err}`);
});

const ticketsKey = 'tickets';
const ticketsTTL = 180; // 3 минуты


exports.readAll = function (request, response) {

    // Предположим - что у нас запрос в базу (который занимает очень много времени)
    console.log("In DB");
    // console.log(ticketsFromDB);

    // let ticketsResult = ticketsFromDB;

    redisClient.get(ticketsKey, (err, result) => {
        if (err) {
            console.error(`Error getting value: ${err}`);
        } else if (result) {
            // Значение найдено в кеше
            // Оно лежало как строка - по этому я возвращаю текст
            console.log(`Value from cache: ${result}`);
            return response.status(200).text(result);
        } else {
            // Установка значения в кеш на стороне сервера
            redisClient.setex(ticketsKey, ticketsTTL, JSON.stringify(ticketsFromDB), (err, setResult) => {
                if (err) {
                    console.error(`Error setting value: ${err}`);
                } else {
                    console.log(`Value set in cache: ${setResult}`);
                }
                return response.status(200).json(ticketsResult);
            });
        }
        console.log('result no found')
        return response.status(200).json(ticketsResult);
    });


}
