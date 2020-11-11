<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MFacturas extends Model
{
    //
protected $table='facturas';
protected $primaryKey='id';
public $timestamps=false;

protected $fillable = [
    'id_cliente', //
    'id_orden', //
    'factura_numero', //
    'fecha_factura', //
    'forma_de_pago', //
    'fecha_vencimiento', //
    'od_valor_total', //
    'oi_valor_total', //
    'montura_iva', //
    'montura_valor_grabado', //
    'montura_valor_total', //
    'subtotal', //
    'iva', //
    'total', //
    'nota_credito', //
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
