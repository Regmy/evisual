<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MFacturaItem extends Model
{
    //
protected $table='facturas_items';
protected $primaryKey='id';
public $timestamps=false;

protected $fillable = [
    'id_orden', //
    'producto', //
    'descripcion', //
    'cantidad', //
    'valor_unitario', //
    'iva', //
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
