<?php

namespace App\Services;

use App\Models\Photo;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PhotoService implements EntityServiceInterface
{

    function index(Request $request): LengthAwarePaginator
    {
        $per_page = $request->input('per_page', 2);
        $page = $request->input('page', 1);

        // $photos = Photo::with('category')->paginate($per_page);

        // Если в качестве метода кеширования установлен редис - я могу использовать этот метод
        $photos = Cache::remember('photo_page' . $page . 'per_page' . $per_page, env('CACHE_PHOTO_ALL_TTL', 600)
            , function  () use ($per_page, $page) {
                $photos = Photo::with('category')->paginate($per_page, ['*'], 'page', $page);
                info("Читаю с базы");
                info($photos);
                return $photos;
            });

        return $photos;
    }

    function show(int $id): Model
    {
        $photo = Cache::remember('photo_id_' . $id, env('CACHE_PHOTO_ALL_TTL', 600),
            function  () use ($id) {
                $photo = Photo::where('id', '=', $id)
                    ->with('category', 'tags')->first();
                info("Читаю с базы для фотки: " . $id);
                info($photo);
                return $photo;
            });

        return $photo;
    }
}
