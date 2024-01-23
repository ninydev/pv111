<?php

namespace App\Services\Photos;

use App\Jobs\OptimizeUploadPhotoJob;
use App\Models\Photo;
use App\Notifications\UserUploadPhotoNotification;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoService implements EntityServiceInterface
{

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        info(' С сущностью работает сервис');
        $photos = Photo::with('category')->paginate($per_page, ['*'], 'page', $page);
        return $photos;
    }

    function store(Request $request) : Model
    {
        $photo = new Photo($request->all());
        $photo->save();
        $user_id = $request->user()->id;

        // Получаем файл из запроса
        $file = $request->file('photo');
        // Генерируем уникальное имя для файла
        $filename = time() . '_' . $file->getClientOriginalName();

        // Есть некая картинка
        // - 1 Нужно сохранить в оригинальном качестве -- name.Jpeg, name.Png, name.Jpg ...
        // - 2 Нужно изменить формат изображения и привести его к WebP -- name.webp
        // - 3 Нужно подготовить прелоады (скажем 100 на 100) -- name.thumb.webp

        // Вариант - когда я строю имена файлов на основе id сущности:
        // А что если при загрузке фотки - я буду давать ей имя - {photo_id} - и разрешение оригинала
        // Тогда в качестве url - у меня будет ссылка на оригинал
        // А что бы увидеть оптимизированное изображение я построю его руками
        // {store_link}/{container_name}/{user_id}/{photo_id}/{photo_id}.webp
        // {store_link}/{container_name}/{user_id}/{photo_id}/{photo_id}.thumb.webp
        // --------------------
        // такой вариант будет удобен, если как id я использую UUID - тип

        // То есть - лучше использовать такую конструкцию:
        $extension = $file->getClientOriginalExtension();
        $filename = $photo->id . '.original.' .  $extension;

        // Получите путь к файлу
        $filePath = $file->storeAs('user_id_' . $user_id . '/photo_id_' . $photo->id, $filename);
        // Получите URL файла
        $fileUrl = url(Storage::url($filePath));

        // Сохраняем URL в базе
        $photo->url = $fileUrl;

        // Уведомим пользователя о том, что его фото загружено
        // $request->user()->notify(new UserUploadPhotoNotification());

        try {
            $photo->save();
            OptimizeUploadPhotoJob::dispatch($photo->id);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }

        return $photo;
    }

    function show(int $id): Model
    {
        info(' С сущностью работает сервис');
        $photo = Photo::where('id', '=', $id)
        ->with('category', 'tags')->first();
        return $photo;
    }

    public function update(Model $entity): bool
    {
        return $entity->update();
    }

    public function destroy(int $id): void
    {
        $photo = Photo::findOrFail($id);
        $photo->tags()->detach();
        $photo->delete();
    }
}
