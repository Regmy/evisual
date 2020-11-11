<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MBodegas extends Model
{
    //
protected $table='bodega';
protected $primaryKey='id_bdg';
public $timestamps=false;

protected $fillable = [
    'bodega', //
    'referencia', //
    'codigo', //
    'grupo_familia', //
    'marca', //
    'manifiesto', //
    'costo', //
    'precio', //
    'tipo', //
    'material', //
    'unidad_de_medida', //
    'invima', //
    'lote', //
    'color', //
    'cantidad', //

];

/**
 * The attributes that should be hidden for arrays.
 *
 * @var array
 */
protected $hidden = [
    //
];

}
