<?php

namespace eVisual\Http\Controllers;

use Illuminate\Http\Request;
use eVisual\MClientes;
use eVisual\User;
use eVisual\MFacturaItem;
use eVisual\MAbonos;
use eVisual\MServioptica;
use eVisual\MFacturas;
use eVisual\MCertificado;
use eVisual\MCotizaciones;
use eVisual\MOrdenDetalles;
use eVisual\MFacturaRango;
use Illuminate\Support\Facades\Redirect; //para poder redireccionar
use eVisual\Http\Requests\RClientes;
use eVisual\Http\Requests\UserRequest;
use eVisual\Http\Requests\FacturaItemRequest;
use eVisual\Http\Requests\CertificadoRequest;
use DB;
use Milon\Barcode\DNS1D;
use PDF;
// Barryvdh\DomPDF\Facad


class PDFController extends Controller
{
    public function index(Request $request, MClientes $clientes)
    {
        if($request){
            $buscar=trim($request->get('searchText')); //Buscar Cliente por documento
            $clientes=DB::table('clientes')->where('dato2','LIKE','%'.$buscar.'%')
            ->orderBy('dato2','desc')->paginate(15);
        return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar]);           
       }
       else{
           $buscar=trim($request->get('searchText')); //Buscar Cliente por documento
            $clientes=DB::table('clientes')->where('dato11','=', auth()->user()->sede)
            ->orderBy('dato2','desc')->paginate(15);
        return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar]);
       }
    }

    public function createitem(MOrdenDetalles $orden)
    {
        $cliente=MClientes::find($orden->cliente_id);
        return view("clientes.facturaadd",["orden"=>$orden, "cliente" =>$cliente]);
    }

    public function certificadoStore(CertificadoRequest $request)
    { 
        if (MCertificado::where('orden_id','=',$request->input('idOrden'))->exists()) 
        {
            $certificado =MCertificado::where('orden_id','=',$request->input('idOrden'))->first();
            $certificado->texto=trim($request->input('textoCertificado'));
            $certificado->tipo=trim($request->input('tipoCertificado'));
            $certificado->fecha=date("y-m-d");
            $certificado->update();
            $idcliente=$request->input('idCliente');
            return redirect()->route('ordenes.index', $idcliente)->withStatus(__('Texto Modificado Sastifactoriamente.'));
        }
        else
        {
            $certificado = new Mcertificado();
            $certificado->texto=trim($request->input('textoCertificado')); //
            $certificado->orden_id=trim($request->input('idOrden')); //
            $certificado->tipo=trim($request->input('tipoCertificado')); //
            $certificado->fecha=date("y-m-d");
            $certificado->save();
            $idcliente=$request->input('idCliente');
            return redirect()->route('ordenes.index', $idcliente)->withStatus(__('Texto Agregado Sastifactoriamente.'));
        }
    }

    public function certificadoadd(MOrdenDetalles $orden)
    {
        $cliente=MClientes::find($orden->cliente_id);

        $idUsuario = $orden->usuario->id; 
        // $idUsuario=User::where('nombre','=',$orden->dato58)->get();
        $usuario = $orden->usuario;
        // $usuario=User::find($idUsuario[0]->id);
        $texto="";
        $tipo="EV I";
        if (MCertificado::where('orden_id','=',$orden->id)->exists()) 
        {
            $certificado =MCertificado::where('orden_id','=',$orden->id)->first();
            $texto=$certificado->texto;
            $tipo=$certificado->tipo;
        }

        return view('clientes.certificadoadd',
        ["cliente"=>$cliente,
         "usuario"=>$usuario,
         "orden"=>$orden,
         "texto"=>$texto,
         "tipo"=>$tipo,
         ]);
    }

    public function abono_data(MOrdenDetalles $orden)
    {
         // Inicializacion de variables
         $acumValorGrabado=0;
         $acumIva=0;
         $acumTotal=0;
         $saldoTotal=0;         
        // Se llama con metodos GET Segun no se usa en api, se puede borrar
        $cliente=MClientes::find($orden->cliente_id);
        $idUsuario = $orden->usuario->id; 
        // $idUsuario=User::where('nombre','=',$orden->dato58)->get();
        $usuario = $orden->usuario;
        // $usuario=User::find($idUsuario[0]->id);
        $facturaItemsExist = false ;
        //Tratamiento de los Items, en caso de que no existan
        if (MFacturaItem::where('id_orden','=',$orden->id)->exists()) 
        {
            $facturaItemsExist = true ;
        }

        $facturaItems =MFacturaItem::where('id_orden','=',$orden->id)->get();

        //Tratamiento de la factura, en caso de que no se haya grabado previamente
        if (MFacturas::where('id_orden',$orden->id)->exists()) 
        {
            $factura = MFacturas::where('id_orden',$orden->id)->first();
        }
        else
        {
            $factura = new MFacturas();
            $factura->id_cliente='';
            $factura->id_orden='';
            $factura->factura_numero='';
            $factura->fecha_factura='';
            $factura->forma_de_pago='';
            $factura->fecha_vencimiento='';
            $factura->od_valor_total='';
            $factura->oi_valor_total='';
            $factura->montura_iva='';
            $factura->montura_valor_grabado='';
            $factura->montura_valor_total='';
            $factura->subtotal='';
            $factura->iva='';
            $factura->total='';
            $factura->nota_credito='';
        }
        
        //Tratamiento de variable para los valores nulos
        if (!is_numeric($orden->dato34)) {
            $orden->dato34 = 0;
        }
        if (!is_numeric($orden->dato36)) {
            $orden->dato36 = 0;
        }

         //Calculando Abonos y saldo.
         $acumAbono=0;
         $abonos = MAbonos::where('orden_id','=',$orden->id)->get();
         foreach($abonos as $abono)
         {
             $acumAbono= $acumAbono + $abono->valor;
         }
         $acumAbono = $acumAbono + (int)$orden->dato37;
         $saldo = $orden->dato36 - $acumAbono;
 
         // Factura y Items Agregados
         $string = explode("-", $orden->fecha);
         $nOrden = $string[0] . $string[1] . $orden->id;
         
        //  $facturaRango = MFacturaRango::where('sede','=',$usuario->sede)->first();
         $facturaRango = MFacturaRango::find($usuario->sede->id);

         // Tratamiento de Variable en caso de que sean nulos. 

         /* if( $facturaRango->inicio == null){
            $facturaRango->inicio = 0;
         }
         if( $facturaRango->fin == null){
            $facturaRango->fin = 0;
         }      */    

         $minFact = $facturaRango->inicio;
         $maxFact = $facturaRango->fin;
        
         $nFactura = DB::table('orden_detalle as a')    //ARREGLA ESTA CONSULTA A ELOQUENT Y AL LAZY LOAD
              ->select('a.nro_fact')
             ->leftjoin('usuarios as b','a.dato58','=','b.nombre')
             ->where('a.nro_fact','>=',(int)$minFact)
             ->where('a.nro_fact','<=',(int)$maxFact)
             ->where('b.sede_id', $usuario->sede->id )
             ->orderBy('a.nro_fact','desc')
              ->first(); //solo el asesor que creó la orden.
            if($nFactura){
                $nFactura= $nFactura->nro_fact;
            }
            else{
                $nFactura= 0;
            }


         $nFactura= strval((int)$nFactura + 1);
         $valorTotalOD=number_format(( ((int)$orden->dato36 - (int)$orden->dato34 ) / 2), 0, '.', '.');     
         $valorTotalOI=number_format(( ((int)$orden->dato36 - (int)$orden->dato34 ) / 2), 0, '.', '.');     
         $monturaIva= number_format( (int)$orden->dato34 - (int)$orden->dato34 / 1.19, 0, '.', '.'); 
         $monturaValorGrabado= number_format( (int)$orden->dato34 / 1.19, 0, '.', '.');
         $monturaValorTotal= @number_format( (int)$orden->dato34, 0, '.', '.');
 
         
         
         // Limpiando Valores si la orden está en Estado "Pedido Laboratorio"
         /* if ($orden->dato59  == "PEDIDO_LABORATORIO")
         {
             $orden->dato34="";
             $orden->dato35="";
             $orden->dato36="";
             $acumAbono="";
             $saldo="";
             $cliente->dato2="";
             $cliente->dato3="";
             $cliente->dato4="";
             $cliente->dato6="";
         } */

          //Explode del correo:
        if (strpos($cliente->dato6, '@') !== false){
            $correoExplode= explode("@",$cliente->dato6);
            $correo= $correoExplode[0].' '.'@'. $correoExplode[1];
        }
        else{
            $correo= $cliente->dato6;   
        }

        // Total, Sub total , IVA
        // dd($orden,$orden->dato36,$orden->dato34,$orden->dato59);
        $subTotal= number_format(((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19), 0, '.', '.');
        $iva= number_format(( $orden->dato34 - $orden->dato34 / 1.19), 0, '.', '.');
        $total= number_format(( ((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19 ) + $orden->dato34 - $orden->dato34 / 1.19), 0, '.', '.');
        $total2= ( ((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19 ) + $orden->dato34 - $orden->dato34 / 1.19);       

        // dd($subTotal, $iva, $total, $total2);

        return
        ["cliente"=>$cliente,
         "usuario"=>$usuario,
         "nOrden"=>$nOrden,
         "nFactura"=>$nFactura,
         "orden"=>$orden,
         "facturaItemsExist"=>$facturaItemsExist, 
         "facturaRango"=>$facturaRango,
         "valorTotalOD"=>$valorTotalOD,
         "valorTotalOI"=>$valorTotalOI,
         "monturaIva" =>$monturaIva,
         "monturaValorGrabado"=>$monturaValorGrabado,
         "monturaValorTotal"=>$monturaValorTotal,
         "correo"=>$correo,
         "facturaItems"=>$facturaItems,
         "factura"=>$factura,
         "acumValorGrabado"=>$acumValorGrabado,
         "acumAbono"=>$acumAbono,
         "subTotal"=>$subTotal,
         "iva"=>$iva,
         "total"=>$total,
         "acumIva"=>$acumIva,
         "acumTotal"=>$acumTotal,
         "saldo"=>$saldo,
         "saldoTotal"=>$saldoTotal,
         "abonos"=>$abonos,
         ];
    }

    public function abono(MOrdenDetalles $orden)
    {
        $data_view = $this->abono_data($orden);

        return view('clientes.HTMLAbono', $data_view);
    }

    public function abonoToPDF(MOrdenDetalles $orden)
    {
        $data_view = $this->abono_data($orden);
         
         return PDF::loadView('clientes.PDF.PDFAbono', $data_view)
        ->stream('Abono.pdf');
    }

    public function factura(MOrdenDetalles $orden)
    {
         // Inicializacion de variables
         $acumValorGrabado=0;
         $acumIva=0;
         $acumTotal=0;
         $saldoTotal=0;
        // Se llama con metodos GET Segun no se usa en api, se puede borrar
        $cliente=MClientes::find($orden->cliente_id);
        $idUsuario=User::where('nombre','=',$orden->dato58)->get();
        $usuario=User::find($idUsuario[0]->id);
        $facturaItemsExist = false ;
        //Tratamiento de los Items, en caso de que no existan
        if (MFacturaItem::where('id_orden','=',$orden->id)->exists()) 
        {
            $facturaItemsExist = true ;
        }

        $facturaItems =MFacturaItem::where('id_orden','=',$orden->id)->get();

        //Tratamiento de la factura, en caso de que no se haya grabado previamente
        if (MFacturas::where('id_orden','=',$orden->id)->exists()) 
        {
            $factura=MFacturas::where('id_orden','=',$orden->id)->first();
        }
        else
        {
            $factura = new MFacturas();
            $factura->id_cliente='';
            $factura->id_orden='';
            $factura->factura_numero='';
            $factura->fecha_factura='';
            $factura->forma_de_pago='';
            $factura->fecha_vencimiento='';
            $factura->od_valor_total='';
            $factura->oi_valor_total='';
            $factura->montura_iva='';
            $factura->montura_valor_grabado='';
            $factura->montura_valor_total='';
            $factura->subtotal='';
            $factura->iva='';
            $factura->total='';
            $factura->nota_credito='';
        }
        
        //Tratamiento de variable para los valores nulos
        if (!is_numeric($orden->dato34)) {
            $orden->dato34 = 0;
        }
        if (!is_numeric($orden->dato36)) {
            $orden->dato36 = 0;
        }

         //Calculando Abonos y saldo.
         $acumAbono=0;
         $abonos = MAbonos::where('orden_id','=',$orden->id)->get();
         foreach($abonos as $abono)
         {
             $acumAbono= $acumAbono + $abono->valor;
         }
         $acumAbono = $acumAbono + (int)$orden->dato37;
         $saldo = $orden->dato36 - $acumAbono;
 
         // Factura y Items Agregados
         $string = explode("-", $orden->fecha);
         $nOrden = $string[0] . $string[1] . $orden->id;
 
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
             $nFactura= $nFactura->nro_fact;
         // dd($usuario->sede, $nFactura, $minFact, $maxFact);

         $nFactura= strval((int)$nFactura + 1);
         $valorTotalOD=number_format(( ((int)$orden->dato36 - (int)$orden->dato34 ) / 2), 0, '.', '.');     
         $valorTotalOI=number_format(( ((int)$orden->dato36 - (int)$orden->dato34 ) / 2), 0, '.', '.');     
         $monturaIva= number_format( (int)$orden->dato34 - (int)$orden->dato34 / 1.19, 0, '.', '.'); 
         $monturaValorGrabado= number_format( (int)$orden->dato34 / 1.19, 0, '.', '.');
         $monturaValorTotal= @number_format( (int)$orden->dato34, 0, '.', '.');
 
         
         
         // Limpiando Valores si la orden está en Estado "Pedido Laboratorio"
         if ($orden->dato59  == "PEDIDO_LABORATORIO")
         {
             $orden->dato34="";
             $orden->dato35="";
             $orden->dato36="";
             $acumAbono="";
             $saldo="";
             $cliente->dato2="";
             $cliente->dato3="";
             $cliente->dato4="";
             $cliente->dato6="";
         }

          //Explode del correo:
        if (strpos($cliente->dato6, '@') !== false){
            $correoExplode= explode("@",$cliente->dato6);
            $correo= $correoExplode[0].' '.'@'. $correoExplode[1];
        }
        else{
            $correo= $cliente->dato6;   
        }

        // Total, Sub total , IVA
        $subTotal= number_format(((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19), 0, '.', '.');
        $iva= number_format(( $orden->dato34 - $orden->dato34 / 1.19), 0, '.', '.');
        $total= number_format(( ((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19 ) + $orden->dato34 - $orden->dato34 / 1.19), 0, '.', '.');
        $total2= ( ((($orden->dato36 - $orden->dato34 ) / 2 ) + (($orden->dato36 - $orden->dato34 ) / 2 ) + $orden->dato34 / 1.19 ) + $orden->dato34 - $orden->dato34 / 1.19);       

        // dd($subTotal, $iva, $total, $total2);

        return view('clientes.PDFFActura',
        ["cliente"=>$cliente,
         "usuario"=>$usuario,
         "nOrden"=>$nOrden,
         "nFactura"=>$nFactura,
         "orden"=>$orden,
         "facturaItemsExist"=>$facturaItemsExist, 
         "facturaRango"=>$facturaRango,
         "valorTotalOD"=>$valorTotalOD,
         "valorTotalOI"=>$valorTotalOI,
         "monturaIva" =>$monturaIva,
         "monturaValorGrabado"=>$monturaValorGrabado,
         "monturaValorTotal"=>$monturaValorTotal,
         "correo"=>$correo,
         "facturaItems"=>$facturaItems,
         "factura"=>$factura,
         "acumValorGrabado"=>$acumValorGrabado,
         "acumAbono"=>$acumAbono,
         "subTotal"=>$subTotal,
         "iva"=>$iva,
         "total"=>$total,
         "acumIva"=>$acumIva,
         "acumTotal"=>$acumTotal,
         "saldo"=>$saldo,
         "saldoTotal"=>$saldoTotal,
         "abonos"=>$abonos,
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \nuevo-nombre\mRegistro  $mRegistro
     * @return \Illuminate\Http\Response
     */
    public function edit(MOrdenDetalles $orden)
    {
        //  Se llama con metodos GET Segun no se usa en api, se puede borrar
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

        $string = explode("-", $orden->fecha);
        $nOrden = $string[0] . $string[1] . $nSede . $orden->id;

        $facturaRango =MFacturaRango::where('sede','=',$usuario->sede)->first();
        $minFact=$facturaRango->inicio;
        $maxFact=$facturaRango->fin;

        $nFactura = MOrdenDetalles::select('nro_fact')
             ->leftjoin('usuarios','orden_detalle.dato58','=','usuarios.nombre')
             ->where('orden_detalle.nro_fact','>=',$minFact)
             ->where('orden_detalle.nro_fact','<=',$maxFact)
             ->where('usuarios.sede','=', $usuario->sede) //solo el asesor que creó la orden.
             ->max('nro_fact');
             
        //dd($usuario->sede, $nFactura, $minFact, $maxFact);
        $nFactura= strval((int)$nFactura + 1);

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
        //dd($subTotal, $iva, $total);
        // Inicializacion de variables
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
// -------------------- Orden PDF -----------------------------------------------
    public function orden_data(MOrdenDetalles $orden)
    {
        $cliente=MClientes::find($orden->cliente_id);
        $idUsuario = $orden->usuario->id;
        $usuario =  $orden->usuario;
        // $idUsuario=User::where('nombre','=',$orden->dato58)->get();
        // $usuario=User::find($idUsuario[0]->id); 

        //Tratamiento de variable para los valores nulos
        if (!is_numeric($orden->dato34)) {
            $orden->dato34 = 0;
        }
        if (!is_numeric($orden->dato36)) {
            $orden->dato36 = 0;
        }

        //Calculando Abonos y saldo.
        $acumAbono=0;
        $abonos = MAbonos::where('orden_id','=',$orden->id)->get();
        foreach($abonos as $abono)
        {
            $acumAbono= $acumAbono + $abono->valor;
        }
        $acumAbono = $acumAbono + (int)$orden->dato37;
        $saldo = $orden->dato36 - $acumAbono;        
       
        $string = explode("-", $orden->fecha);
        $nOrden = $string[0] . $string[1] . $orden->id;

        $facturaRango = MFacturaRango::where('id',$usuario->sede->id)->first();
        
         return 
        ["cliente"=>$cliente,
         "acumAbono"=>$acumAbono,
         "saldo"=>$saldo,
         "usuario"=>$usuario,
         "nOrden"=>$nOrden,
         "orden"=>$orden,
         "facturaRango"=>$facturaRango,
         ];       
    }

    public function orden(MOrdenDetalles $orden)
    {
        $data_view = $this->orden_data($orden);

        return view('clientes.HTMLOrden', $data_view);
    }

    public function ordenToPDF(MOrdenDetalles $orden)
    {
        $data_view = $this->orden_data($orden);
         
         return PDF::loadView('clientes.PDF.PDFOrden', $data_view)
        ->stream('Orden.pdf');
    }

// ---------------------- Cotizacion PDF -------------------

    public function cotizacion_data(MCotizaciones $cotizacion)
    {
        $cliente = MClientes::find($cotizacion->cliente_id);        
        $usuario= $cotizacion->usuario; 

          //Tratamiento de variable para los valores nulos
        if (!is_numeric($cotizacion->dato34)) {
            $cotizacion->dato34 = 0;
        }
        if (!is_numeric($cotizacion->dato36)) {
            $cotizacion->dato36 = 0;
        }

        //Calculando Abonos y saldo.
        $acumAbono=0;
        $abonos = MAbonos::where('orden_id','=','9999999999')->get();
        foreach($abonos as $abono)
        {
            $acumAbono= $acumAbono + $abono->valor;
        }
        $acumAbono = $acumAbono + (int)$cotizacion->dato37;
        $saldo = $cotizacion->dato36 - $acumAbono;

        // Limpiando Valores si la cotizacion está en Estado "Pedido Laboratorio"
        if ($cotizacion->dato59  == "PEDIDO_LABORATORIO")
        {
            $cotizacion->dato34="";
            $cotizacion->dato35="";
            $cotizacion->dato36="";
            $acumAbono="";
            $saldo="";
            $cliente->dato2="";
            $cliente->dato3="";
            $cliente->dato4="";
            $cliente->dato6="";
        }    

        $string = explode("-", $cotizacion->fecha);
        $ncotizacion = $string[0] . $string[1] . $cotizacion->id;
        
        $facturaRango = MFacturaRango::find($usuario->sede->id);
        // $facturaRango = MFacturaRango::where('sede','=',$usuario->sede)->first();

        return
        ["cliente"=>$cliente,
         "acumAbono"=>$acumAbono,
         "saldo"=>$saldo,         
         "usuario"=>$usuario,
         "ncotizacion"=>$ncotizacion,
         "cotizacion"=>$cotizacion,
         "facturaRango"=>$facturaRango,
         ];
    }

    public function cotizacion(MCotizaciones $cotizacion)
    {
        $data_view = $this->cotizacion_data($cotizacion);

        return view('clientes.HTMLCotizacion', $data_view);
    }

    public function cotizacionToPDF(MCotizaciones $cotizacion)
    {
        $data_view = $this->cotizacion_data($cotizacion);
         
         return PDF::loadView('clientes.PDF.PDFCotizacion', $data_view)
        ->stream('Cotizacion.pdf');
    }

// ------------------ Laboratorio PDF ---------------------------
    public function laboratorio_data(MOrdenDetalles $orden)
    {
        $cliente    = MClientes::find($orden->cliente_id);
        $idUsuario  = $orden->usuario_id;
        $usuario    = User::find($orden->usuario_id);   //ARREGLAR ESTO; CARGAR EL USUARIO DE FORMA LAZYLOAD
        $montura= "";   //ARREGLAR ESTO, YA EL VALOR ESTA CUANDO SE HACE LA CONSULTA ABAJO.
        $nueva= "";
        $usada= "";
        $ref= "";
        $rayada= "";
        $pelada= "";
        $otro= "";

        if (MServioptica::where('id_orden',$orden->id)->exists()) 
        {
            $servioptica= MServioptica::where('id_orden',$orden->id)->firstOrFail();
            $montura    = $servioptica->so_montura;
            $nueva      = $servioptica->so_nueva;
            $usada      = $servioptica->so_usada;
            $ref        = $servioptica->so_ref;
            $rayada     = $servioptica->so_rayada;
            $pelada     = $servioptica->so_pelada;
            $otro       = $servioptica->so_otro;
        }
          //Tratamiento de variable para los valores nulos
          if (!is_numeric($orden->dato34)) {
            $orden->dato34 = 0;
        }
        if (!is_numeric($orden->dato36)) {
            $orden->dato36 = 0;
        }

        //Calculando Abonos y saldo.
        $acumAbono=0;
        $abonos = MAbonos::where('orden_id','=',$orden->id)->get();
        foreach($abonos as $abono)
        {
            $acumAbono= $acumAbono + $abono->valor;
        }
        $acumAbono = $acumAbono + (int)$orden->dato37;
        $saldo = $orden->dato36 - $acumAbono;

        // Limpiando Valores para la orden de Laboratorio        
        $orden->dato34  = "";
        $orden->dato35  = "";
        $orden->dato36  = "";
        $acumAbono      = "";
        $saldo          = "";
        $cliente->dato2 = "";
        $cliente->dato3 = "";
        $cliente->dato4 = "";
        $cliente->dato6 = "";
       
        // TITULO       
        $string = explode("-", $orden->fecha);
        $nOrden = $string[0] . $string[1] . $orden->id;

        $facturaRango = MFacturaRango::find($usuario->sede->id);
        // $facturaRango =MFacturaRango::where('sede','=',$usuario->sede)->firstOrFail();

        return 
        ["cliente"=>$cliente,
         "acumAbono"=>$acumAbono,
         "saldo"=>$saldo,
         "usuario"=>$usuario,
         "nOrden"=>$nOrden,
         "orden"=>$orden,
         "facturaRango"=>$facturaRango,
         "montura"=>$montura,
         "nueva"=>$nueva,
         "usada"=>$usada,
         "ref"=>$ref,
         "rayada"=>$rayada,
         "pelada"=>$pelada,
         "otro"=>$otro,
         ];                  
    }

    public function laboratorio(MOrdenDetalles $orden)
    {
        $data_view = $this->laboratorio_data($orden);

        return view('clientes.HTMLLaboratorio', $data_view);
    }

    public function laboratorioToPDF(MOrdenDetalles $orden)
    {
        $data_view = $this->laboratorio_data($orden);
         
         return PDF::loadView('clientes.PDF.PDFLaboratorio', $data_view)
        ->stream('Laboratorio.pdf');
    }

    public function certificado_data(MOrdenDetalles $orden)
    {
        $cliente=MClientes::find($orden->cliente_id);

        $idUsuario = $orden->usuario->id;
        // $idUsuario=User::where('nombre','=',$orden->dato58)->get();
        $usuario = $orden->usuario;
        // $usuario=User::find($idUsuario[0]->id);   //ELIMINAR ESTO YA QUE VIENE CARGADO POR LAZYLOAD
        $string = explode("-", $orden->fecha);
        $nOrden = $string[0] . $string[1] . $orden->id;
        $facturaRango = MFacturaRango::find($usuario->sede->id);

        // Obtenemos el texto generado de la BD:
        
        $textoCertificado = "";
        $tipoCertificado = "EV I";

        if(MCertificado::where('orden_id','=',$orden->id)->exists())
        {
            $certificado =MCertificado::where('orden_id','=',$orden->id)->first();
            $textoCertificado = $certificado->texto;
            $tipoCertificado = $certificado->tipo;
        }

        if ($tipoCertificado ==""){
            $tipoCertificado = 'EV I';
        }

        return
        ["cliente"=>$cliente,
         "textoCertificado"=>$textoCertificado,
         "tipoCertificado"=>$tipoCertificado,
         "usuario"=>$usuario,
         "orden"=>$orden,
         "nOrden" => $nOrden,
         "facturaRango" => $facturaRango,
         ];
    }

    public function certificado(MOrdenDetalles $orden)
    {
        $data_view = $this->certificado_data($orden);

        return view('clientes.HTMLCertificado', $data_view);
    }

    public function certificadoToPDF(MOrdenDetalles $orden)
    {
        $data_view = $this->certificado_data($orden);
         
         return PDF::loadView('clientes.PDF.PDFCertificado', $data_view)
        ->stream('Certificado.pdf');
    }
}
