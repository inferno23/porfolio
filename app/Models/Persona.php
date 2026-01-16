<?php

namespace App\Models;

//use App\User;
use App\Models\User;
use App\Models\Registro;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'pais_id', 'localidad_id', 'provincia_id', 'nombre', 'dni', 'country', 'admin_id', 'user_id', 'institucion', 'domicilio', 'mesa', 'orden'
    ];

   


    

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    
   

    
}
