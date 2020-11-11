<?php

namespace eVisual\Http\Controllers;

use Illuminate\Http\Request;
use eVisual\MClientes;
use eVisual\User;
use eVisual\MFacturaItem;
use eVisual\MFacturas;
use eVisual\MOrdenDetalles;
use eVisual\MFacturaRango;
use Illuminate\Support\Facades\Redirect;
use eVisual\Http\Requests\RClientes;
use eVisual\Http\Requests\UserRequest;
use eVisual\Http\Requests\FacturaItemRequest;
use eVisual\Http\Requests\FacturaRequest;
use eVisual\Http\Requests\NotaCreditoRequest;
use DB;

class FacturaController extends Controller
{    
    public function createitem(MOrdenDetalles $orden)
    {
        $cliente=MClientes::find($orden->cliente_id);

        return view("clientes.facturaadd",["orden"=>$orden, "cliente" =>$cliente]);
    }

    public function store(FacturaRequest $request)
    { 
        $factura = new MFacturas();
        $factura->id_cliente=trim($request->input('idCliente')); //
        $factura->id_orden=trim($request->input('idOrden')); //
        $factura->factura_numero=trim($request->input('nFactura')); //
        $factura->fecha_factura=trim($request->input('fechaFactura')); //
        $factura->forma_de_pago=trim($request->input('formaPago')); //
        $factura->fecha_vencimiento=trim($request->input('fechaVencimiento')); //
        $factura->od_valor_total=trim($request->input('valorTotalOD')); //
        $factura->oi_valor_total=trim($request->input('valorTotalOI')); //
        $factura->montura_iva=trim($request->input('monturaIva')); //
        $factura->montura_valor_grabado=trim($request->input('monturaValorGrabado')); //
        $factura->montura_valor_total=trim($request->input('monturaValorTotal')); //
        $factura->subtotal=trim($request->input('subtotal')); //
        $factura->iva=trim($request->input('iva')); //
        $factura->total=trim($request->input('total')); //
        $factura->save();
        $idcliente=$request->input('idCliente');
        
        return redirect()->route('ordenes.index', $idcliente)->withStatus(__('Factura Grabada Sastifactoriamente.'));
    }

    public function storeItem(FacturaItemRequest $request)
    { 
        $facturaItem = new MFacturaItem();
        $idcliente=$request->input('idCliente');
        $facturaItem->id_orden=trim($request->input('idOrden'));
        $facturaItem->producto=trim($request->input('producto')); 
        $facturaItem->descripcion=trim($request->input('descripcion')); 
        $facturaItem->cantidad=trim($request->input('cantidad')); 
        $facturaItem->valor_unitario=trim($request->input('precioUnitario')); 
        $facturaItem->iva=trim($request->input('iva')); 
        $facturaItem->save();

        return redirect()->route('ordenes.index', $idcliente)->withStatus(__('Producto Agregado Sastifactoriamente.'));    
    }

    public function nCreditoStore(NotaCreditoRequest $request, MOrdenDetalles $orden)
    {
        $orden->nota_credito=trim($request->input('nota1'));
        $orden->nota_credito2=trim($request->input('nota2'));
        $orden->nota_credito3=trim($request->input('nota3'));
        $orden->nota_credito4 = (int)trim($request->input('nota4')) - (int)$request->input('nota3') - (int)$request->input('nota2') - (int)$request->input('nota1');
        $orden->nota_credito_texto=trim($request->input('notaTexto'));
        $orden->update();

       return redirect()->route('ordenes.index', $orden->cliente_id)->withStatus(__('Nota Credito Agregada Sastifactoriamente.'));
    }

    public function edit(MOrdenDetalles $orden)
    {
        $cliente=MClientes::find($orden->cliente_id);
        $idUsuario=User::where('nombre','=',$orden->dato58)->get();
        $usuario=User::find($idUsuario[0]->id);
        
        $nSede="";
        $img="";

        if ($usuario->sede == "ITAGUI") {
            $nSede = 01;
            $img = "itagui";
        };
        if ($usuario->sede == "BELLO" || $usuario->sede == "VPB BELLO" || $usuario->sede == "EVB EVOLUCIÃ“N VISUAL BELLO") {
            $nSede = 02;
            $img = "bello";
        };
        if ($usuario->sede == "PIONERA") {
            $nSede = 03;
            $img = "pionera";
        };
        if ($usuario->sede == "PRICE") {
            $nSede = 04;
            $img = "nn";
        };
        if ($usuario->sede == "EVM") {
            $nSede = 05;
            $img = "evm";
        };

        //Tratamiento de variable para los valores nulos
        if (!is_numeric($orden->dato34)) {
            $orden->dato34 = 0;
        }
        if (!is_numeric($orden->dato36)) {
            $orden->dato36 = 0;
        }

        $string = explode("-", $orden->fecha);
        $nOrden = $string[0] . $string[1] . $nSede . $orden->id;

        $facturaRango =MFacturaRango::where('sede','=',$usuario->sede)->first();
        $minFact=$facturaRango->inicio;
        $maxFact=$facturaRango->fin;
       
        $nFactura = DB::table('orden_detalle as a')
             ->select('a.nro_fact')
            ->leftjoin('usuarios as b','a.dato58','=','b.nombre')
            ->where('a.nro_fact','>=',(int)$minFact)
            ->where('a.nro_fact','<=',(int)$maxFact)
            ->where('b.sede','=', $usuario->sede )
            ->orderBy('a.nro_fact','desc')
             ->first(); //solo el asesor que creó la orden.
            $nFactura= (int)$nFactura->nro_fact;
        // dd($usuario->sede, $nFactura, $minFact, $maxFact);
        $nFactura= strval($nFactura + 1);

        $valorTotalOD=number_format(( ($orden->dato36 - $orden->dato34 ) / 2), 0, '.', '.');     
        $valorTotalOI=number_format(( ($orden->dato36 - $orden->dato34 ) / 2), 0, '.', '.');     
        $monturaIva= number_format( $orden->dato34 - $orden->dato34 / 1.19, 0, '.', '.'); 
        $monturaValorGrabado= number_format( $orden->dato34 / 1.19, 0, '.', '.');
        $monturaValorTotal= @number_format( $orden->dato34, 0, '.', '.');

        //explode del correo:
        
        if (strpos($cliente->dato6, '@') !== false){
            $correoExplode= explode("@",$cliente->dato6);
            $correo= $correoExplode[0].' '.'@'. $correoExplode[1];
        }
        else{
            $correo= $cliente->dato6;   
        }
        // Items Agregados a la Factura
        $facturaItems = MFacturaItem::where('id_orden', $orden->id)->first();
        
        // Total, Sub total , IVA
        $subTotal= number_format(((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19), 0, '.', '.');
        $iva= number_format(( $orden->dato34 - $orden->dato34 / 1.19), 0, '.', '.');
        $total= number_format(( ((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19 ) + $orden->dato34 - $orden->dato34 / 1.19), 0, '.', '.'); 
        // Inicializacion de variables.
        $acumValorGrabado=0;
        $acumIva=0;
        $acumTotal=0;

        return view('clientes.facturaPreview',
        ["cliente"=>$cliente,
         "usuario"=>$usuario,
         "nOrden"=>$nOrden,
         "nFactura"=>$nFactura,
         "orden"=>$orden,
         "facturaRango"=>$facturaRango,
         "valorTotalOD"=>$valorTotalOD,
         "valorTotalOI"=>$valorTotalOI,
         "monturaIva" =>$monturaIva,
         "monturaValorGrabado"=>$monturaValorGrabado,
         "monturaValorTotal"=>$monturaValorTotal,
         "correo"=>$correo,
         "facturaItems"=>$facturaItems,
         "acumValorGrabado"=>$acumValorGrabado,
         "subTotal"=>$subTotal,
         "iva"=>$iva,
         "total"=>$total,
         "acumIva"=>$acumIva,
         "acumtotal"=>$acumTotal,
         ]);
    }
    public function notaCredito(MOrdenDetalles $orden)
    {
        $cliente=MClientes::find($orden->cliente_id);
        $idUsuario = $orden->usuario->id;
        $usuario = $orden->usuario;
        // $idUsuario=User::where('nombre','=',$orden->dato58)->get();
        // $usuario=User::find($idUsuario[0]->id);
        
        $nSede="";
        $img="";

        if ($usuario->sede == "ITAGUI") {
            $nSede = 01;
            $img = "itagui";
        };
        if ($usuario->sede == "BELLO" || $usuario->sede == "VPB BELLO" || $usuario->sede == "EVB EVOLUCIÃ“N VISUAL BELLO") {
            $nSede = 02;
            $img = "bello";
        };
        if ($usuario->sede == "PIONERA") {
            $nSede = 03;
            $img = "pionera";
        };
        if ($usuario->sede == "PRICE") {
            $nSede = 04;
            $img = "nn";
        };
        if ($usuario->sede == "EVM") {
            $nSede = 05;
            $img = "evm";
        };

        $string = explode("-", $orden->fecha);
        $nOrden = $string[0] . $string[1] . $nSede . $orden->id;

        $facturaRango =MFacturaRango::find($usuario->sede->id);
        // $facturaRango =MFacturaRango::where('sede','=',$usuario->sede)->first();
        $minFact=$facturaRango->inicio;
        $maxFact=$facturaRango->fin;
       
        $nFactura = DB::table('orden_detalle as a')
             ->select('a.nro_fact')
            ->leftjoin('usuarios as b','a.dato58','=','b.nombre')
            ->where('a.nro_fact','>=',(int)$minFact)
            ->where('a.nro_fact','<=',(int)$maxFact)
            ->where('b.sede_id','=', $usuario->sede->id )
            ->orderBy('a.nro_fact','desc')
             ->first(); //solo el asesor que creó la orden.
            $nFactura= (int)$nFactura->nro_fact;
        // dd($usuario->sede, $nFactura, $minFact, $maxFact);
        $nFactura= strval($nFactura + 1);

         //Tratamiento de variable para los valores nulos
         if (!is_numeric($orden->dato34)) {
            $orden->dato34 = 0;
        }
        if (!is_numeric($orden->dato36)) {
            $orden->dato36 = 0;
        }

        $valorTotalOD=number_format(( ($orden->dato36 - $orden->dato34 ) / 2), 0, '.', '.');     
        $valorTotalOI=number_format(( ($orden->dato36 - $orden->dato34 ) / 2), 0, '.', '.');     
        $monturaIva= number_format( $orden->dato34 - $orden->dato34 / 1.19, 0, '.', '.'); 
        $monturaValorGrabado= number_format( $orden->dato34 / 1.19, 0, '.', '.');
        $monturaValorTotal= @number_format( $orden->dato34, 0, '.', '.');

        //explode del correo:
        
        if (strpos($cliente->dato6, '@') !== false){
            $correoExplode= explode("@",$cliente->dato6);
            $correo= $correoExplode[0].' '.'@'. $correoExplode[1];
        }
        else{
            $correo= $cliente->dato6;   
        }
        // Items Agregados a la Factura
        //$sql = "SELECT * FROM facturas_items WHERE id_orden = '" . $_SESSION["orden_id"] . "' ";
        $facturaItems =MFacturaItem::where('id_orden','=',$orden->id)->get();
        //$facturaItems=$facturaItems->toJson();
        //$facturaItems=json_decode($facturaItems, true);
        
        // Total, Sub total , IVA
        $subTotal= number_format(((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19), 0, '.', '.');
        $iva= number_format(( $orden->dato34 - $orden->dato34 / 1.19), 0, '.', '.');
        $total= number_format(( ((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19 ) + $orden->dato34 - $orden->dato34 / 1.19), 0, '.', '.');
        $total2 = ( ((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19 ) + $orden->dato34 - $orden->dato34 / 1.19);
        //dd($subTotal, $iva, $total);
        // Inicializacion de variables.
        $acumValorGrabado=0;
        $acumIva=0;
        $acumTotal=0;

        return view('clientes.notaCredito',
        ["cliente"=>$cliente,
         "usuario"=>$usuario,
         "nOrden"=>$nOrden,
         "nFactura"=>$nFactura,
         "orden"=>$orden,
         "facturaRango"=>$facturaRango,
         "valorTotalOD"=>$valorTotalOD,
         "valorTotalOI"=>$valorTotalOI,
         "monturaIva" =>$monturaIva,
         "monturaValorGrabado"=>$monturaValorGrabado,
         "monturaValorTotal"=>$monturaValorTotal,
         "correo"=>$correo,
         "facturaItems"=>$facturaItems,
         "acumValorGrabado"=>$acumValorGrabado,
         "subTotal"=>$subTotal,
         "iva"=>$iva,
         "total"=>$total,
         "total2"=>$total2,
         "acumIva"=>$acumIva,
         "acumtotal"=>$acumTotal,
         ]);
    }

    public function update(RClientes $request, MClientes $cliente)
    {
        // QUE PAJÓ AQUI?? HA??
        // HAS FILIPAO COLEGA!
    }
}
