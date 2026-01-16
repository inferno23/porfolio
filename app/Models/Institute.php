<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table = 'institutes';

    protected $fillable = [
        'pais_id', 'localidad_id', 'provincia_id','name', 'description', 'country', 'admin_id', 'user_id', 'provincia', 'seccion', 'departamento', 'localidad', 'circuito', 'escuela', 'domicilio', 'mdesde', 'mhasta', 'cant_mes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo('countries', 'code', 'country', 'countries');
    }
}
