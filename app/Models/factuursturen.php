<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class factuursturen extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'factuursturen';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'userId',
        'factuurId',
    ];
}
