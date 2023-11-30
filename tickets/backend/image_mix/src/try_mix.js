


// предложение оп формированию файлового хранилища
// let path = backset_name + "/" + image_id + "/" + image_type;


const Jimp = require('jimp');

// Пути к изображениям
const base_path = './basket_name/image_id/';

const photo_no_bg = base_path + 'photo_no_bg.png';
const background = base_path + 'background.jpg';
const photo_result = base_path + 'result.jpg';

// Загрузка изображений
Jimp.read(photo_no_bg)
    .then(load_photo_no_bg => {
        Jimp.read(background)
            .then(load_background => {

                // throw new Object({message: "Я выкинул свою ошибку"});

                // Размеры изображений
                const width = Math.max(load_photo_no_bg.getWidth(), load_background.getWidth());
                const height = Math.max(load_photo_no_bg.getHeight(), load_background.getHeight());

                // Тут может быть много логики
                // Например - привести картинки к одному размеру, ужать, обрезать e.t.c

                // Создание нового изображения
                const mergedImage = new Jimp(width, height);

                // Совмещение изображений
                mergedImage.composite(load_background, 0, 0);
                mergedImage.composite(load_photo_no_bg, 0, 0);

                // Сохранение нового изображения
                mergedImage.write(photo_result);

                // Далее пойдет сообщение
            })
            .catch(err => {
                console.error(err);
            });
    })
    .catch(err => {
        console.error(err);
    });
