<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MClientes extends Model
{
    //
    protected $table='clientes';
    public $timestamps=false;

    protected $fillable = [
        'dato1', //Nombre
        'dato2', //Documento
        'dato3', //Celular
        'dato4', //Telefono
        'dato5', //Fecha de nacimiento
        'dato6', //Correo
        'dato7', //Direccion
        'dato8', //Municipio
        'dato9', //Observaciones
        'dato10', //Fecha de creacion
        'factura_rango_id', //Sede
        'tipodoc', //Tipo de documento  "CC,TI,CE,PASAPORTE"

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function sede(){
            
        // Especificamos que un cliente pertenece a una sede.
        return $this->belongsTo(MFacturaRango::class,'factura_rango_id');
        
    }

}
