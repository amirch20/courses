<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document_homework extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_title',
        'document_description',
        'document_file',
        'deleted_at',

    ];
}
