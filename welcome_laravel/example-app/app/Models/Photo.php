<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    // Список полей, которые можно менять в базе данных
    protected $fillable = [
        'name', 'description'
    ];
}
