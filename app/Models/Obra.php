<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $table = 'obras';

    protected $fillable = [
        'titulo','descripcion', 'image','fecha', 'horainicio',  'horafin', 'activo',
    ];
/*
    public function user()
    {
        return $this->belongsTo(User::class);
    }


*/
    
}
