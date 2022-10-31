<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class descrBolAccount extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'descriptionBolAccount';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'bolId',
        'userId',
        'description',
    ];
}
