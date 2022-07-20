<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture_audio extends Model
{
    use HasFactory;
    protected $fillable = [
        'audio_title',
        'audio_description',
        'audio_file',
        'deleted_at',
    ];
}
