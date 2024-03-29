<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\CreatePhotoRequest;
use App\Models\Photo;
use App\Notifications\UserUploadPhotoNotification;
use App\Services\CacheService;
use App\Services\Interfaces\EntityServiceInterface;
use App\Services\Photos\PhotoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use OpenApi\Attributes as OAT;

class PhotoController extends Controller
{
    private EntityServiceInterface $photoService;
    public function __construct(
        PhotoService $photoService)
    {
        // $this->photoService = $photoService;
        $this->photoService = new CacheService($photoService,
        'photo_pages_', 'photo_id',
            env('CACHE_PHOTO_ALL_TTL', 30), env('CACHE_PHOTO_ID', 30));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 2);
        $page = $request->input('page', 1);
        return $this->photoService->index($page, $per_page);
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
        return $this->photoService->show($id);
//        $photo = Photo::where('id', '=', $id)
//            ->with('category', 'tags')->get();


//        // forever вместо remember
//        // Фотографию в кеше можно хранить вечно (пока не будет у нее что то заменено)
//        $photo = Cache::remember('photo_id_' . $id, env('CACHE_PHOTO_ALL_TTL', 600),
//            function  () use ($id) {
//                $photo = Photo::where('id', '=', $id)
//                    ->with('category', 'tags')->get();
//                info("Читаю с базы для фотки: " . $id);
//                info($photo);
//                return $photo;
//            });
//
//        return $photo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        Cache::forget('photo_id_' .$photo->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $photo = Photo::findOrFail($id);

        Cache::forget('photo_id_' .$photo->id);

        Cache::flush('photo_page*');

        // Отсоединяем все теги перед удалением фотографии
        $photo->tags()->detach();

        $photo->delete();

        return response()->json([], 204);
    }


}
