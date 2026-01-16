<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'localidad_id','provincia_id','pais_id','name', 'email', 'password','is_active',   'organizacion_id',  'tiempo_suscripcion', 'role','cargo','detalle','precandidato','imagen','celular','telefono',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function persona()
    {
       // return $this->hasMany(Persona::class, 'id');
        return $this->hasMany(Persona::class );
    }

    public function grupo()
    {
       // return $this->hasMany(Persona::class, 'id');
        return $this->hasMany(Grupo::class );
    }

    public function organizacion()
    {
      
       
        return $this->belongsTo(Organizacion::class, 'organizacion_id');
    }


    public function telegrama()
    {
      
        return $this->hasMany(Telegrama::class );
    }


    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    
}
