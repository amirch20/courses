<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture_Text extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'text',
        'deleted_at',
    ];
}
