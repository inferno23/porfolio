<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $table = 'candidatos';

    protected $fillable = [
        'color','municipal', 'diputado_provincial','intendente', 'concejal',  'presidente', 'senador', 'diputado','gobernador', 'lista', 'partido', 'cargo', 'orden','image', 'is_active','pais_id', 'provincia_id','localidad_id', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    
}
