<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture_Other_Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_title',
        'video_description',
        'video_url',
        'deleted_at',
    ];
}
