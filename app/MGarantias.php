<?php

namespace eVisual;

use Illuminate\Database\Eloquent\Model;

class MGarantias extends Model
{
   //
protected $table='garantia_detalle';
protected $primaryKey='id';
public $timestamps=false;

protected $fillable = [
    'cliente_id', //
    'fecha', //&
    //OD
    'dato0', //Fecha de entrega
    'dato1', //Hora de enrega valor por defecto 12:00pm
    'dato2', //Esfera
    'dato3', //Cilindro
    'dato4', //Eje
    'dato5', //Adicion
    'dato6', //D.N.P.
    'dato7', //Altura
    'dato8', //Prisma
    'dato9', //Lente
    'dato10', //Lab.
    'dato11', //No.
    'dato12', //Bisel
    'dato13', //Lote
    //OI
    'dato14', //Esfera i
    'dato15', //Cilindro i
    'dato16', //Eje i
    'dato17', //Adicion i
    'dato18', //D.N.P i
    'dato19', //Altura i
    'dato20', //Prisma i
    'dato21', //Lente i
    'dato22', //Lab. i
    'dato23', //No. i
    'dato24', //Bisel i
    'dato25', //Lote i
    //Lente
    'dato26', //Tipo
    'dato27', //Clase de Progresivo
    'dato28', //INVIMA
    'dato29', //Tratamiento
    'dato30', //Color LTE
    'dato31', //Material
    'dato32', //Médico
    //Valor Descripción
    'dato33', //Referenciav
    'dato34', //Vr.Monturav
    'dato35', //Vr.Lente
    'dato36', //Total
    'dato37', //Abono Inicial
    'dato38', //Saldo
    'dato39', //Material
    'dato40', //hidden class cincuenta
    'dato41', //hidden class cincuenta
    'dato42', //Tipo
    'dato43', //hidden class cincuenta
    'dato44', //hidden class cincuenta
    'dato45', //Color Mont
    //Medidas
    'dato46', //Horizontal
    'dato47', //Vertical
    'dato48', //Puente
    'dato49', //Diagonal
    'dato50', //Dist. Mecánica
    'dato51', //#Almacena
    'dato52', //D. Vertice
    'dato53', //
    'dato54', //Panorámico
    'dato55', //Pantoscopico
    'dato56', //Nro. Remisión
    'dato57', //Observaciones
    'dato58', //Usuario Activo que genera la Orden
    'dato59', // se agrega en el controlador el estado por defecto de la orden creada es cuarentena de la sede que se infiere del usuario que la crea
    
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
