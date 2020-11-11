<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MFacturaRango extends Model
{
    //
protected $table='facturas_rango';
// protected $primaryKey='id_fct';
public $timestamps=false;

protected $fillable = [
    'sede', //
    'inicio', //
    'fin', //
    'texto', //
    'prefijo', //
    'resolucion', //
    'iva', //
    'rango_rc_inicio', //
    'rango_rc_fin', //
    'imagen_logo', //
    'imagen_datos', //
    'texto_devolucion', //
    'texto_horarios', //
];

public function users(){
    
    // Especificamos que una Sede tiene muchos Usuarios. 
    // Se le pasa como segundo parametro la llave foranea ya que esta
    // no está bajo la convencion (factura_rango_id).
    return $this->hasMany(User::class, 'sede_id');
}

/**
 * The attributes that should be hidden for arrays..
 *
 * @var array
 */
protected $hidden = [
    //
];

}
