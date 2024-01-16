<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhotoCategoryModel extends Model
{
    use HasFactory;

    protected $table = 'photo_categories';
    protected $fillable = [
        'name'
    ];

    public function photos() : HasMany
    {
        return $this
            ->hasMany(Photo::class
                , 'category_id'
                , 'id'
            );
    }


}
