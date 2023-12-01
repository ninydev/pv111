const uuid = require('uuid');
const sendImageToRemoveBg = require('./../helpers/send_remove_bg');

exports.create = function (request, response) {

    let photo_url = '/need/upload/photo';
    let bg_url = '/need/upload/bg';

    let newFakeImage = {
        id: uuid.v4(),
        name: request.body.name || 'fake Name',
        photo_url: photo_url,
        bg_url: bg_url,
        createdAt: Date.now()
    }

    console.log('Start process:')
    console.log(newFakeImage)

    sendImageToRemoveBg(newFakeImage);
    return response.status(201).json(newFakeImage);
}
