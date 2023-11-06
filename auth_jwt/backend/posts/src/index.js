// Сам веб сервер (приложение)
let express = require('express');
let app = express();



// Запустим веб сервер
app.listen(80, () => {
    console.log("http server started");
});
