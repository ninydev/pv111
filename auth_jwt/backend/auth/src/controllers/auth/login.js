
// Модуль, который принимает Http Request и Http Response
exports.login = function (request, response) {
    // Если пользователь ничего не прислал - возвращаю статус 400
    if(!request.body) return response.sendStatus(400);

    // Получаю данные из тела запроса
    console.log(request.body);
    let user = request.body;

    // Формирую результат обработки запроса
    let result = {
        "user": user
    };

    // Возвращаю статус 200 (все прошло ОК) и результат работы
    return response.status(200).json(result);
}
