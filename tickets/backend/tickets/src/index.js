// Сам веб сервер (приложение)
let express = require('express');
let app = express();

const fileUpload = require('express-fileupload');
app.use(fileUpload());

// Использовать body в запросах
// Для работы JSON
app.use(express.json());
const urlencodedParser = express.urlencoded({extended: false});

// Настройка маршрута
app.post("/api/tickets", urlencodedParser, require ('./controllers/tickets/create').create)
app.get("/api/tickets", require('./controllers/tickets/readAll').readAll);

// Запустим веб сервер
app.listen(80, () => {
    console.log("http server started");
});
