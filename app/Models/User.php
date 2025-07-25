<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; // <- Importante
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public $timestamps = true;

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
