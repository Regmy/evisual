<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MAbonos extends Model
{
    //
protected $table='abonos';
protected $primaryKey='id';
public $timestamps=false;

protected $fillable = [
    'orden_id', //
    'valor', //
    'fecha', //
    'tipo_pago', //

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
