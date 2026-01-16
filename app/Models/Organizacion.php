<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    protected $table = 'organizaciones';

    protected $fillable = [
        'localidad_id','provincia_id','pais_id','organizacion', 'ejecutivo_nacional', 'country', 'admin_id', 'user_id', 'provincia', 'lista', 'ejecutivo_provincial', 'localidad', 'ejecutivo_municipal', 'ejecutivo_comunal', 'senador', 'diputado', 'consejal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provincias()
    {
       
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    public function localidades()
    {
       
        return $this->belongsTo(Localidad::class, 'localidad_id');
    }
}
