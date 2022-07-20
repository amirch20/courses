<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class add_assessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_title',
        'quiz_duration',
        'total_marks',
        'instrument',
        'deleted_at',
    ];
}
