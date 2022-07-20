<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video_homework extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_title',
        'video_description',
        'video_file',
        'deleted_at',

    ];
}
