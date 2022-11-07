<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class dynamisch extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'dynamisch';
    public $timestamps = false;
    protected $fillable = [
        'bolPrijs'
    ];
}
