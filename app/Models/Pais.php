<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais';

    protected $fillable = [
        'paisnombre', 'pais_id', 'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
