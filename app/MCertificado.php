<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MCertificado extends Model
{
   //
protected $table='certificado_texto';
protected $primaryKey='id';
public $timestamps=false;

protected $fillable = [
    'orden_id', //
    'texto', //
    'fecha', //
    'tipo', //
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
