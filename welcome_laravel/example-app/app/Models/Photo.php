<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;

class Photo extends Model
{
    use HasFactory;

    // Список полей, которые можно менять в базе данных
    protected $fillable = [
        'name', 'description' // , 'category_id'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(PhotoCategoryModel::class, 'category_id');
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(PhotoTag::class,
            'pivot_photo_tags', 'photo_id', 'tag_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            Log::debug('saved');

            $request = request();

            Log::debug('saving tags ' . json_encode($request->input('tags')));
            Log::debug('saving category ' . json_encode($request->input('category_id')));


            $model->category()->associate($request->input('category_id'));

            // Пример сохранения связанных моделей (предположим, у вас есть отношение "tags")
            if ($request->has('tags')) {
                $model->tags()->attach($request->input('tags'));
            }
        });

        static::saving(function ($model) {
            // Код, который будет выполнен перед сохранением
            // Например, вы можете получить доступ к объекту запроса таким образом:
            $request = request();

            // Допустим, вы хотите изменить некоторые данные перед сохранением
            // $model->someAttribute = $request->input('some_value');

        });


        // Обработка события "deleting"
        static::deleting(function ($photo) {
            // Отсоединяем все теги перед удалением фотографии
            $photo->tags()->detach();
        });
    }

}
