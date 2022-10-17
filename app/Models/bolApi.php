<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class bolApi extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'bolApi';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'userId',
        'userIdApi',
    ];
}
