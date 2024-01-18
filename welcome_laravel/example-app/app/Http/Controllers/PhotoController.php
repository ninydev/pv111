<?php

namespace App\Http\Controllers;

use App\Events\UserUploadPhotoEvent;
use App\Http\Requests\Photo\CreatePhotoRequest;
use App\Jobs\UserUploadPhotoJob;
use App\Models\Photo;
use App\Notifications\UserUploadPhotoNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\Translation\t;

use OpenApi\Attributes as OAT;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Photo::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     * Если я доку пропишу здесь ???
     */
    #[OAT\Post(
        tags: ['photo'],
        path: '/api/photo',
        summary: 'Create new photo',
        operationId: 'photo.store',
        responses: [
            new OAT\Response(
                response: HttpResponse::HTTP_CREATED,
                description: 'Created'
            ),
            new OAT\Response(
                response: HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
                description: 'Unprocessable entity'
            ),
        ]
    )]
    public function store(CreatePhotoRequest $request)
    {
        try {

            $photo = $request->getModelFromRequest();

            // получение автора фотографии
            $user_id = $request->user()->id;

//            Log::debug('userId', [$user_id] );
//            Log::debug('user', [json_encode($request->user())] );

            // Получаем файл из запроса
            $file = $request->file('photo');
            // Генерируем уникальное имя для файла
            $filename = time() . '_' . $file->getClientOriginalName();

            // Получите путь к файлу
            $filePath = $file->storeAs('public/photos', $filename);
            // Получите URL файла
            $fileUrl = url(Storage::url($filePath));

            // Сохраняем URL в базе
            $photo->url = $fileUrl;

            try {
                $photo->save();
                Log::debug('Controller Save:', [date('H:i:s') . '.' . microtime(true)]);
                // Генерация события (принято, что событие обрабатывается в том же потоке
                // event(new UserUploadPhotoEvent($photo));
                // UserUploadPhotoEvent::dispatch($photo);

                // Генерация фонового задания
                // UserUploadPhotoJob::dispatch();

                // Уведомим пользователя о том, что его фото загружено
                $request->user()->notify(new UserUploadPhotoNotification());

            } catch (\Exception $e) {

            }





//            if ($request->has('tags')) {
//                $photo->tags()->attach($request->input('tags'));
//            }
            Log::debug('Controller Finish:', [date('H:i:s') . '.' . microtime(true)]);
            return $photo;
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $photo = Photo::where('id', '=', $id)
            ->with('category', 'tags')->get();
        return $photo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $photo = Photo::findOrFail($id);

        // Отсоединяем все теги перед удалением фотографии
        $photo->tags()->detach();

        $photo->delete();

        return response()->json([], 204);
    }


}
