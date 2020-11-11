<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MServioptica extends Model
{
   //
protected $table='servioptica';
protected $primaryKey='id';
public $timestamps=false;

protected $fillable = [
    'id_orden', //
    'so_montura', //
    'so_nueva', //
    'so_usada', //
    'so_ref', //
    'so_rayada', //
    'so_pelada', //
    'so_otro', //
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
