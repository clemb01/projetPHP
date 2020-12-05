<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'notes';
    public $timestamps = false;

    protected $casts = [
        'note' => 'float',
        'film_id' => 'int',
        'fk_user_id' => 'int'
    ];

    protected $fillable = [
        'note',
        'film_id',
        'fk_user_id'
    ];
}
