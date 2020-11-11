<?php

namespace eVisual;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    
    protected $table='usuarios';
    // protected $primaryKey='id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'documento', 
        'contrasena',
        'rol',
        'sede_id',
        'nivelacceso',
        'email',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'contrasena', 
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function sede(){
        
        // Especificamos que un usuario pertenece a una sede.
        return $this->belongsTo(MFacturaRango::class,);
        
    }

    public function isAdmin(){ // Metodo para corroborar que es administrador.
        
        return $this->rol = 'admin';
    }
}