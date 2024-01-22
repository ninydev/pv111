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

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        info(' С сущностью работает сервис');
        $photos = Photo::with('category')->paginate($per_page, ['*'], 'page', $page);
        return $photos;
    }

    function show(int $id): Model
    {
        info(' С сущностью работает сервис');
        $photo = Photo::where('id', '=', $id)
        ->with('category', 'tags')->first();
        return $photo;
    }
}
