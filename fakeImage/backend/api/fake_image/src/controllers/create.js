const uuid = require('uuid');

exports.create = function (request, response) {

    let newFakeImage = {
        id: uuid.v4()
    }

    return response.status(201).json(newFakeImage);
}
