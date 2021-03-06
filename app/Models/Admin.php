<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class Admin extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    protected $guard = 'admin';
    protected $fillable = [
        'first_name',
        'surname',
        'nationality',
        'country',
        'email',
        'password',
        'confirm_password',
        'last_qualification',
        'graduation_year',
        'institution_name',
        'qualification_country',
        'upload_transcript',
        'date_of_birth',
        'gender',
        'phone_number',
        'alternative_phone_number',
        'address',
        'current_address',
        'additional_information',
        'deleted_at',
    ];
}
