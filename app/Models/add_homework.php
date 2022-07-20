<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class add_homework extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'deadline',
        'lession_type',
        'deleted_at',
    ];
}
