<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';

    protected $fillable = [
        'provincia', 'pais_id', 'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
