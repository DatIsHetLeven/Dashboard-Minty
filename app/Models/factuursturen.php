<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factuursturen extends Model
{
    use HasFactory;

    protected $table = 'factuursturen';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'userId',
        'factuurId',
    ];
}


