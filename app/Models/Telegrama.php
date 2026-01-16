<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Telegrama extends Model
{
    protected $table = 'telegramas';

    protected $fillable = [
        'total_padron', 'localidad_id','votos_comunal', 'votos_diputado_prov','votos_consejal','imagen','mesa','cantidad_votantes', 'cantidad_sobres', 'votos_nulos', 'votos_recurridos', 'votos_impugnados', 'votos_comandas', 'votos_blancos', 'organizacion_id', 'user_id', 'candidato_id', 'valor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }




    public function candidato()
    {
       
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }
   

    
}
