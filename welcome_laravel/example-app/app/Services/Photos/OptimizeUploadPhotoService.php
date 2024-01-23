<?php

namespace App\Services\Photos;

use App\Models\Photo;
use App\Services\Interfaces\JobServiceInterface;
use Illuminate\Support\Facades\Storage;
use Imagick;
use function Laravel\Prompts\error;

class OptimizeUploadPhotoService implements JobServiceInterface
{
    public function __construct(
        private int $photo_id
    )
    {
    }

    public function handle()
    {
        // Наша фото
        $photo = Photo::query()->find($this->photo_id);
        info('Photo to work: ', $photo->toArray());
//$photo->author_id
        $fileDir = '/user_id_' . '2' . '/photo_id_' . $photo->id  .'/';
//        $filePath = '/user_id_' . '2' .
//            '/photo_id_' . $photo->id
//            .'/' . $photo->id . '.original.jpg';
//        info ($filePath);

// Получение содержимого файла
        $fileContents = Storage::get($fileDir . $photo->id. '.original.jpg');
        // info ($fileContents);

        // Проверка, является ли файл изображением
        if (@getimagesizefromstring($fileContents)) {
            // Получение информации о размерах и типе сжатия
            $imageInfo = getimagesizefromstring($fileContents);
            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $mime = $imageInfo['mime'];

            // Вывод информации
            info( "Это изображение размером {$width}x{$height} с MIME-типом: {$mime}");

            $imagick = new Imagick();
            $imagick->readImageBlob($fileContents);
            $imagick->setImageFormat('jpeg');

            // $image->cropImage(190, 300, 350, 565);
            $imagick->resizeImage(100, 100, Imagick::FILTER_CATROM, 0);

            Storage::put($fileDir . $photo->id . '.thumb.jpg', $imagick->getImageBlob());



        } else {
            echo info("Этот файл не является изображением.");
        }

    }
}
