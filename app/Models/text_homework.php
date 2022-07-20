<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class text_homework extends Model
{
    use HasFactory;
    protected $fillable = [
        'add_question_text',
        'question_type',
        'deleted_at',

    ];
}
