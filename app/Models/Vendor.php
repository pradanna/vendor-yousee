<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'brand',
        'email',
        'password',
        'picName',
        'picPhone',
        'last_seen'
    ];

    protected $hidden = [
        'password',
    ];
}
