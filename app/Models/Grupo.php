<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupo';

    protected $fillable = [
        'descripcion', 'descripcion', 'admin_id', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }




    public function administrador()
    {
       
        return $this->belongsTo(User::class, 'admin_id');
    }
    


    
}
