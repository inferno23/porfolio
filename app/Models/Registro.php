<?php

namespace App\Models;

use   App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registro';

    protected $fillable = [
        'persona_id', 'institucion_id', 'domicilio_real','telefono','mesa','descripcion', 'admin_id', 'user_id', 'fiscal_general', 'fiscal_mesa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }




    public function persona()
    {
       // return $this->hasMany(Persona::class, 'id');
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    public function escuela()
    {
       // return $this->hasMany(Persona::class, 'id');
        return $this->belongsTo(Institute::class, 'institucion_id');
    }


    
}
