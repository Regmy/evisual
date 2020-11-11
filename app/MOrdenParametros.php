<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MOrdenParametros extends Model
{
protected $table='ordenes_parametros';
protected $primaryKey='id';
public $timestamps=false;

protected $fillable = [
    'campo', //formula
    'option_value', //valor de la formula
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
