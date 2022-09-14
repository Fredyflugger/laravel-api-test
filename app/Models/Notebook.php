<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;
    // Поля которые можно заполнить
    protected $fillable = [
        'name',
        'phone',
        'email',
        'birth_date',
        'photo',
        'company',
    ];
}
