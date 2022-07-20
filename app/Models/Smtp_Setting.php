<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smtp_Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'protocol',
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'deleted_at',

    ];
}
