<?php

namespace eVisual\Http\Controllers;

use Illuminate\Http\Request;
use eVisual\MOrdenDetalles;
use eVisual\MClientes;
use eVisual\MServioptica;
use eVisual\MOrdenParametros;
use Illuminate\Support\Facades\Redirect;
use eVisual\Http\Requests\ROrdenDetalles;
use eVisual\Http\Requests\LaboratorioRequest;
use DB;

class COrdenDetalles extends Controller
{

    /* prueba esto:

$string = iconv("UTF-8","UTF-8//IGNORE",$string);
De acuerdo con iconv manual , la función tomará el primer parámetro como conjunto de caracteres de entrada, 
el segundo parámetro como conjunto de caracteres de salida y el tercero como la cadena de entrada real.

Si establece el conjunto de caracteres de entrada y salida en UTF-8 , y agrega el indicador //IGNORE al conjunto de caracteres
de salida, la función eliminará (quitará) todos los caracteres de la cadena de entrada que no pueden representarse por el conjunto
de caracteres de salida. Por lo tanto, filtrando la cadena de entrada en efecto. */

    function index( Request $request, MClientes $cliente )
    {
        $buscar=trim($request->get('searchText'));
        $ordenes=DB::table('orden_detalle as a')   //Pasar a Eloquent
        ->leftjoin('facturas as b','a.id','=','b.id_orden')
        ->select('b.id_orden','a.id','a.fecha', 'a.dato58','a.dato0', 'a.dato1','a.dato59','a.nota_credito','a.nota_credito2','a.nota_credito3','a.nota_credito4','a.nota_credito_texto')
        ->where('cliente_id','=',$cliente->id)
        ->orderBy('fecha','desc')->paginate(15);
        
        return view( 'clientes.orden', compact( 'cliente' ), [ "ordenes" => $ordenes, "searchText"=>$buscar ] );    
    }

    function create(MClientes $cliente, Request $request)
    {
        $refractive = [
            'color' => "",
            'treatment' => "",
            'detail' => "",
            'lens_type' => "",
        ];
        $refractive = (object) $refractive;
        $refractive_re = [
            'rx_sphere'=>"",
            'rx_cylinder'=>"",
            'rx_axis'=>"",
            'rx_add'=>"--",
            'rx_np'=>"",
        ];
        $refractive_re = (object) $refractive_re;           
        $refractive_le = $refractive_re;

        $medicol = MOrdenParametros::where( 'campo', 'medico' )->get();
        $esfera = MOrdenParametros::where( 'campo', 'formula_OD_esfera' )->get();        
        $cilindro = MOrdenParametros::where( 'campo', 'formula_OD_cilindro' )->get();
        $adicion = MOrdenParametros::where( 'campo', 'formula_OD_adicion' )->get();
        $lente = MOrdenParametros::where( 'campo', 'formula_OD_lente' )->get();
        $lab = MOrdenParametros::where( 'campo', 'formula_OI_lab' )->get();        
        $bisel = MOrdenParametros::where( 'campo', 'formula_OI_bisel' )->get();        
        $tipol = MOrdenParametros::where( 'campo', 'lente_tipo' )->get();        
        $tratamientol = MOrdenParametros::where( 'campo', 'lente_tratamiento' )->get();
        $claseProgresivol = MOrdenParametros::where( 'campo', 'lente_clase_de_progresivo' )->get();        
        $colorLtel = MOrdenParametros::where( 'campo', 'color_lte' )->get();                
        $materiall = MOrdenParametros::where( 'campo', 'lente_material' )->get();                
        $colorMontm = MOrdenParametros::where( 'campo', 'color_mont' )->get();
        //FALTA EL PARAMETRO DE NRO DE FACTURA RECOMENDADA
    
        if($request->has('_token')){
            if( $request->get('idHistoriaOptisoftSearch') != "" ){
                    $historiaOptisoft = DB::connection('mysqlopti')->table('appointments')->where('id',$request->get('idHistoriaOptisoftSearch'))->first();                                                             
                    if(!is_null($historiaOptisoft)){                         
                        $refractive = (object) json_decode($historiaOptisoft->refractive, true);
                        $refractive_re = (object) json_decode($historiaOptisoft->refractive_re, true);
                        $refractive_le = (object) json_decode($historiaOptisoft->refractive_le, true);
                        if ( empty( (array)$refractive)) {
                            $refractive->color ="";
                            $refractive->treatment="";
                            $refractive->detail="";
                            $refractive->lens_type="";
                        }
                        if ( empty( (array)$refractive_re)) {
                            $refractive_re->rx_sphere ="";
                            $refractive_re->rx_cylinder="";
                            $refractive_re->rx_axis="";
                            $refractive_re->rx_add="--";
                            $refractive_re->rx_np="";
                        }
                        if ( empty( (array)$refractive_le)) {
                            $refractive_le->rx_sphere ="";
                            $refractive_le->rx_cylinder="";
                            $refractive_le->rx_axis="";
                            $refractive_le->rx_add="--";
                            $refractive_le->rx_np="";
                        }

                        return view('clientes.nueva_orden',compact('cliente'),
                        ["esfera"=>$esfera, 
                        "cilindro"=>$cilindro, 
                        "adicion"=>$adicion,
                        "lente"=>$lente,
                        "lab"=>$lab,
                        "bisel"=>$bisel,
                        "tipol"=>$tipol,
                        "tratamientol"=>$tratamientol,
                        "claseProgresivol"=>$claseProgresivol,
                        "colorLtel"=>$colorLtel,
                        "materiall"=>$materiall,
                        "medicol"=>$medicol,
                        "colorMontm"=>$colorMontm,
                        "refractive" =>$refractive,                        
                        "refractive_re" =>$refractive_re,                        
                        "refractive_le" =>$refractive_le,                        
                        ]); 
                    }
                    else{
                        return redirect()->route('ordenes.create', $cliente->id)->with('badStatus' , 'La Historia Clínica No fue encontrada.');
                    }
            }
            else{
                return redirect()->route('ordenes.create' , $cliente->id)->with('badStatus' , 'Debe Ingresar el N° de la Historia Clínica.');
            }
        }

        return view('clientes.nueva_orden',compact('cliente'),
        ["esfera"=>$esfera, 
        "cilindro"=>$cilindro, 
        "adicion"=>$adicion,
        "lente"=>$lente,
        "lab"=>$lab,
        "bisel"=>$bisel,
        "tipol"=>$tipol,
        "tratamientol"=>$tratamientol,
        "claseProgresivol"=>$claseProgresivol,
        "colorLtel"=>$colorLtel,
        "materiall"=>$materiall,
        "medicol"=>$medicol,
        "colorMontm"=>$colorMontm,
        "refractive" =>$refractive,                        
        "refractive_re" =>$refractive_re,                        
        "refractive_le" =>$refractive_le,                        
        ]);
     }

    function store(ROrdenDetalles $request)
    {
        $orden = new MOrdenDetalles();
        $orden->cliente_id = trim($request->input('idCliente'));
        $orden->usuario_id = auth()->user()->id;
        $orden->fecha = date("y-m-d");
        $orden->dato0 = trim($request->input('fechaEntrega'));
        $orden->dato1 = trim($request->input('horaEntrega'));        
        $orden->dato2 = trim($request->input('esfera'));
        $orden->dato3 = trim($request->input('cilindro'));
        $orden->dato4 = trim($request->input('eje'));
        $orden->dato5 = trim($request->input('adicion'));
        $orden->dato6 = trim($request->input('dnp'));
        $orden->dato7 = trim($request->input('altura'));
        $orden->dato8 = trim($request->input('prisma'));
        $orden->dato9 = trim($request->input('lente'));
        $orden->dato10 = trim($request->input('lab'));
        $orden->dato11 = trim($request->input('nro'));
        $orden->dato12 = trim($request->input('bisel'));
        $orden->dato13 = trim($request->input('lote'));
        $orden->dato14 = trim($request->input('esferai'));
        $orden->dato15 = trim($request->input('cilindroi'));
        $orden->dato16 = trim($request->input('ejei'));
        $orden->dato17 = trim($request->input('adicioni'));
        $orden->dato18 = trim($request->input('dnpi'));
        $orden->dato19 = trim($request->input('alturai'));
        $orden->dato20 = trim($request->input('prismai'));
        $orden->dato21 = trim($request->input('lentei'));
        $orden->dato22 = trim($request->input('labi'));
        $orden->dato23 = trim($request->input('nroi'));
        $orden->dato24 = trim($request->input('biseli'));
        $orden->dato25 = trim($request->input('lotei'));
        $orden->dato26 = trim($request->input('tipol'));
        $orden->dato27 = trim($request->input('claseProgresivol'));
        $orden->dato28 = trim($request->input('invimal'));
        $orden->dato29 = trim($request->input('tratamientol'));
        $orden->dato30 = trim($request->input('colorLtel'));
        $orden->dato31 = trim($request->input('materiall'));
        $orden->dato32 = trim($request->input('medicol'));
        $orden->dato33 = trim($request->input('referenciav'));
        $orden->dato34 = trim($request->input('vrmonturav'));
        $orden->dato35 = trim($request->input('vrlentev'));
        $orden->dato36 = trim($request->input('totalv'));
        $orden->dato37 = trim($request->input('abonoinicialv'));
        $orden->dato38 = trim($request->input('saldov'));
        $orden->dato39 = trim($request->input('materialv'));
        $orden->dato40 = trim($request->input('--'));
        $orden->dato41 = trim($request->input('--'));
        $orden->dato42 = trim($request->input('tipov'));
        $orden->dato43 = trim($request->input('--'));
        $orden->dato44 = trim($request->input('--'));
        $orden->dato45 = trim($request->input('colorMontm'));
        $orden->dato46 = trim($request->input('horizontalm'));
        $orden->dato47 = trim($request->input('verticalm'));
        $orden->dato48 = trim($request->input('puentem'));
        $orden->dato49 = trim($request->input('diagonalm'));
        $orden->dato50 = trim($request->input('distMecanicam'));
        $orden->dato51 = trim($request->input('nroAlmacenm'));
        $orden->dato52 = trim($request->input('dVerticeODm'));
        $orden->dato53 = trim($request->input('dVerticeOIm'));
        $orden->dato54 = trim($request->input('panoramicom'));
        $orden->dato55 = trim($request->input('pantoscopicom'));
        $orden->dato56 = trim($request->input('nroRemisionm'));
        $orden->dato57 = trim($request->input('observaciones'));
        $orden->dato59=trim($request->input('estadoOrden'));
        $orden->nro_fact=trim($request->input('nroFacturav'));
        $orden->curva_base=trim($request->input('curva_base'));        
        $orden->save();
       
        return redirect()->route('ordenes.index', $orden->cliente_id)->withStatus(__('Orden Creada Sastifactoriamente.'));
    }

    function edit( MOrdenDetalles $orden)
    {   
        $medicol = MOrdenParametros::where( 'campo', 'medico' )->get();
        $esfera = MOrdenParametros::where( 'campo', 'formula_OD_esfera' )->get();        
        $cilindro = MOrdenParametros::where( 'campo', 'formula_OD_cilindro' )->get();
        $adicion = MOrdenParametros::where( 'campo', 'formula_OD_adicion' )->get();
        $lente = MOrdenParametros::where( 'campo', 'formula_OD_lente' )->get();
        $lab = MOrdenParametros::where( 'campo', 'formula_OI_lab' )->get();        
        $bisel = MOrdenParametros::where( 'campo', 'formula_OI_bisel' )->get();        
        $tipol = MOrdenParametros::where( 'campo', 'lente_tipo' )->get();        
        $tratamientol = MOrdenParametros::where( 'campo', 'lente_tratamiento' )->get();
        $claseProgresivol = MOrdenParametros::where( 'campo', 'lente_clase_de_progresivo' )->get();        
        $colorLtel = MOrdenParametros::where( 'campo', 'color_lte' )->get();                
        $materiall = MOrdenParametros::where( 'campo', 'lente_material' )->get();                
        $colorMontm = MOrdenParametros::where( 'campo', 'color_mont' )->get();        
        $cliente = Mclientes::find($orden->cliente_id);
        
        return view('clientes.editOrden',
        ["esfera"=>$esfera, 
        "cilindro"=>$cilindro, 
        "adicion"=>$adicion,
        "lente"=>$lente,
        "lab"=>$lab,
        "bisel"=>$bisel,
        "tipol"=>$tipol,
        "tratamientol"=>$tratamientol,
        "claseProgresivol"=>$claseProgresivol,
        "colorLtel"=>$colorLtel,
        "materiall"=>$materiall,
        "medicol"=>$medicol,
        "colorMontm"=>$colorMontm,
        "orden"=>$orden,
        "cliente"=>$cliente,
        ]);                     
    }

    function update(ROrdenDetalles $request ,MOrdenDetalles $orden)
    {            
        $orden->dato0=trim($request->input('fechaEntrega'));
        $orden->dato1=trim($request->input('horaEntrega'));
        $orden->dato2=trim($request->input('esfera'));
        $orden->dato3=trim($request->input('cilindro'));
        $orden->dato4=trim($request->input('eje'));
        $orden->dato5=trim($request->input('adicion'));
        $orden->dato6=trim($request->input('dnp'));
        $orden->dato7=trim($request->input('altura'));
        $orden->dato8=trim($request->input('prisma'));
        $orden->dato9=trim($request->input('lente'));
        $orden->dato10=trim($request->input('lab'));
        $orden->dato11=trim($request->input('nro'));
        $orden->dato12=trim($request->input('bisel'));
        $orden->dato13=trim($request->input('lote'));
        $orden->dato14=trim($request->input('esferai'));
        $orden->dato15=trim($request->input('cilindroi'));
        $orden->dato16=trim($request->input('ejei'));
        $orden->dato17=trim($request->input('adicioni'));
        $orden->dato18=trim($request->input('dnpi'));
        $orden->dato19=trim($request->input('alturai'));
        $orden->dato20=trim($request->input('prismai'));
        $orden->dato21=trim($request->input('lentei'));
        $orden->dato22=trim($request->input('labi'));
        $orden->dato23=trim($request->input('nroi'));
        $orden->dato24=trim($request->input('biseli'));
        $orden->dato25=trim($request->input('lotei'));
        $orden->dato26=trim($request->input('tipol'));
        $orden->dato27=trim($request->input('claseProgresivol'));
        $orden->dato28=trim($request->input('invimal'));
        $orden->dato29=trim($request->input('tratamientol'));
        $orden->dato30=trim($request->input('colorLtel'));
        $orden->dato31=trim($request->input('materiall'));
        $orden->dato32=trim($request->input('medicol'));
        $orden->dato33=trim($request->input('referenciav'));
        $orden->dato34=trim($request->input('vrmonturav'));
        $orden->dato35=trim($request->input('vrlentev'));
        $orden->dato36=trim($request->input('totalv'));
        $orden->dato37=trim($request->input('abonoinicialv'));
        $orden->dato38=trim($request->input('saldov'));
        $orden->dato39=trim($request->input('materialv'));
        $orden->dato42=trim($request->input('tipov'));
        $orden->dato45=trim($request->input('colorMontm'));
        $orden->dato46=trim($request->input('horizontalm'));
        $orden->dato47=trim($request->input('verticalm'));
        $orden->dato48=trim($request->input('puentem'));
        $orden->dato49=trim($request->input('diagonalm'));
        $orden->dato50=trim($request->input('distMecanicam'));
        $orden->dato51=trim($request->input('nroAlmacenm'));
        $orden->dato52=trim($request->input('dVerticeODm'));
        $orden->dato53=trim($request->input('dVerticeOIm'));
        $orden->dato54=trim($request->input('panoramicom'));
        $orden->dato55=trim($request->input('pantoscopicom'));
        $orden->dato56=trim($request->input('nroRemisionm'));
        $orden->dato57=trim($request->input('observaciones'));
        $orden->dato59=trim($request->input('estadoOrden'));
        $orden->nro_fact=trim($request->input('nroFacturav'));
        $orden->obs_lab=trim($request->input('observacionlab'));
        $orden->curva_base=trim($request->input('curvaBase'));
        $orden->update();                

        return redirect()->route('ordenes.index', $orden->cliente_id)->withStatus(__('Orden Actualizada Sastifactoriamente.'));
    }

    function delete(MOrdenDetalles  $orden)
    {
        $orden->delete();
        return redirect()->route('admin.informeFiltro')->withStatus(__('Orden Eliminada Sastifactoriamente.'));
    }

    function deleteOrdenMes(MOrdenDetalles $orden){
        $orden->delete();
        return redirect()->route('admin.informeOrdenMes')->withStatus(__('Orden Eliminada Sastifactoriamente'));
    }

    function editlab( MOrdenDetalles $orden)
    {   
        $medicol = MOrdenParametros::where( 'campo', 'medico' )->get();
        $esfera = MOrdenParametros::where( 'campo', 'formula_OD_esfera' )->get();        
        $cilindro = MOrdenParametros::where( 'campo', 'formula_OD_cilindro' )->get();
        $adicion = MOrdenParametros::where( 'campo', 'formula_OD_adicion' )->get();
        $lente = MOrdenParametros::where( 'campo', 'formula_OD_lente' )->get();
        $lab = MOrdenParametros::where( 'campo', 'formula_OI_lab' )->get();        
        $bisel = MOrdenParametros::where( 'campo', 'formula_OI_bisel' )->get();        
        $tipol = MOrdenParametros::where( 'campo', 'lente_tipo' )->get();        
        $tratamientol = MOrdenParametros::where( 'campo', 'lente_tratamiento' )->get();
        $claseProgresivol = MOrdenParametros::where( 'campo', 'lente_clase_de_progresivo' )->get();        
        $colorLtel = MOrdenParametros::where( 'campo', 'color_lte' )->get();                
        $materiall = MOrdenParametros::where( 'campo', 'lente_material' )->get();                
        $colorMontm = MOrdenParametros::where( 'campo', 'color_mont' )->get();

        if(!MServioptica::where('id_orden','=',$orden->id)->exists()){
            $servioptica = new MServioptica();
            $servioptica->id_orden=$orden->id;
            $servioptica->so_montura = "";
            $servioptica->so_nueva = "";
            $servioptica->so_usada = "";
            $servioptica->so_ref = "";
            $servioptica->so_rayada = "";
            $servioptica->so_pelada = "";
            $servioptica->so_otro = "";
            $servioptica->save();
        }
        else {
            $servioptica = MServioptica::where('id_orden','=',$orden->id)->firstOrFail();
        }

        return view('clientes.laboratorio',
        ["esfera"=>$esfera, 
        "cilindro"=>$cilindro, 
        "adicion"=>$adicion,
        "lente"=>$lente,
        "lab"=>$lab,
        "bisel"=>$bisel,
        "tipol"=>$tipol,
        "tratamientol"=>$tratamientol,
        "claseProgresivol"=>$claseProgresivol,
        "colorLtel"=>$colorLtel,
        "materiall"=>$materiall,
        "medicol"=>$medicol,
        "colorMontm"=>$colorMontm,
        "orden"=>$orden,
        "servioptica"=>$servioptica,
        ]);                           
    }

    function updatelab(LaboratorioRequest $request ,MOrdenDetalles $orden)
    {       
        $orden->dato0=trim($request->input('fechaEntrega'));
        $orden->dato1=trim($request->input('horaEntrega'));
        $orden->dato2=trim($request->input('esfera'));
        $orden->dato3=trim($request->input('cilindro'));
        $orden->dato4=trim($request->input('eje'));
        $orden->dato5=trim($request->input('adicion'));
        $orden->dato6=trim($request->input('dnp'));
        $orden->dato7=trim($request->input('altura'));
        $orden->dato8=trim($request->input('prisma'));
        $orden->dato9=trim($request->input('lente'));
        $orden->dato10=trim($request->input('lab'));
        $orden->dato11=trim($request->input('nro'));
        $orden->dato12=trim($request->input('bisel'));
        $orden->dato13=trim($request->input('lote'));
        $orden->dato14=trim($request->input('esferai'));
        $orden->dato15=trim($request->input('cilindroi'));
        $orden->dato16=trim($request->input('ejei'));
        $orden->dato17=trim($request->input('adicioni'));
        $orden->dato18=trim($request->input('dnpi'));
        $orden->dato19=trim($request->input('alturai'));
        $orden->dato20=trim($request->input('prismai'));
        $orden->dato21=trim($request->input('lentei'));
        $orden->dato22=trim($request->input('labi'));
        $orden->dato23=trim($request->input('nroi'));
        $orden->dato24=trim($request->input('biseli'));
        $orden->dato25=trim($request->input('lotei'));
        $orden->dato26=trim($request->input('tipol'));
        $orden->dato27=trim($request->input('claseProgresivol'));
        $orden->dato28=trim($request->input('invimal'));
        $orden->dato29=trim($request->input('tratamientol'));
        $orden->dato30=trim($request->input('colorLtel'));
        $orden->dato31=trim($request->input('materiall'));
        $orden->dato32=trim($request->input('medicol'));
        $orden->dato33=trim($request->input('referenciav'));
        $orden->dato39=trim($request->input('materialv'));
        $orden->dato42=trim($request->input('tipov'));
        $orden->dato45=trim($request->input('colorMontm'));
        $orden->dato46=trim($request->input('horizontalm'));
        $orden->dato47=trim($request->input('verticalm'));
        $orden->dato48=trim($request->input('puentem'));
        $orden->dato49=trim($request->input('diagonalm'));
        $orden->dato50=trim($request->input('distMecanicam'));
        $orden->dato51=trim($request->input('nroAlmacenm'));
        $orden->dato52=trim($request->input('dVerticeODm'));
        $orden->dato53=trim($request->input('dVerticeOIm'));
        $orden->dato54=trim($request->input('panoramicom'));
        $orden->dato55=trim($request->input('pantoscopicom'));
        $orden->dato56=trim($request->input('nroRemisionm'));
        $orden->dato57=trim($request->input('observaciones'));
        $orden->dato59=trim($request->input('estadoOrden'));
        $orden->nro_fact=trim($request->input('nroFacturav'));
        $orden->obs_lab=trim($request->input('observacionlab'));
        $orden->curva_base=trim($request->input('curvaBase'));
        $orden->update();
               
        $serviOptica = MServioptica::find($request->input('idSO'));
        $serviOptica->so_montura=trim($request->input('SOmontura'));
        $serviOptica->so_nueva=trim($request->input('SOnueva'));
        $serviOptica->so_usada=trim($request->input('SOusada'));
        $serviOptica->so_ref=trim($request->input('SOref'));
        $serviOptica->so_rayada=trim($request->input('SOrayada'));
        $serviOptica->so_pelada=trim($request->input('SOpelada'));
        $serviOptica->so_otro=trim($request->input('SOotro'));
        $serviOptica->update();

        return redirect()->route('ordenes.index', $orden->cliente_id)->withStatus(__('Orden Actualizada Sastifactoriamente.'));
    }
}