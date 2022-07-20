<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture_Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_title',
        'document_description',
        'document_file',
        'deleted_at',
    ];
}
