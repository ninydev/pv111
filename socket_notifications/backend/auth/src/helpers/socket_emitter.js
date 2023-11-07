/**
 * Configure Redis server
 */
const REDIS_SOCKET_HOST = process.env.REDIS_SOCKET_HOST || 'redis.sockets';
const REDIS_SOCKET_PORT = process.env.REDIS_SOCKET_PORT || 6379;
const REDIS_SOCKET_CONNECTION_STRING = `redis://${REDIS_SOCKET_HOST}:${REDIS_SOCKET_PORT}`;

const { Emitter } = require("@socket.io/redis-emitter");
const { createClient } = require("redis"); // not included, needs to be explicitly installed

const createIO = () => {
    return new Promise((resolve, reject) => {
        const redisClient = createClient({
            url: REDIS_SOCKET_CONNECTION_STRING
        });

        redisClient.on('connect', () => {
            console.debug('Connection to Redis server ok');
        });

        redisClient.connect().then(() => {
            const io = new Emitter(redisClient);
            resolve(io);
        }).catch(reject);
    });
};


module.exports = createIO;


// const redisClient = createClient({
//     url: REDIS_SOCKET_CONNECTION_STRING});
//
// redisClient.on('connect', () => {
//     console.debug('Connection to Redis server ok');
// });

// redisClient.connect().then(() => {
//     io = new Emitter(redisClient);
//     setInterval( () => {
//         io.emit("fromAuth", Date.now())
//     }, 5000);
// })



// module.exports = ioSender;
