<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';

    protected $fillable = [
        'localidad',  'id_privincia', 'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
