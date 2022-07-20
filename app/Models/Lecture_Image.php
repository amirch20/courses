<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture_Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_title',
        'image_description',
        'image_file',
        'deleted_at',
    ];
}
