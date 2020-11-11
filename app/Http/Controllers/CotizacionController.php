<?php

namespace eVisual\Http\Controllers;

use Illuminate\Http\Request;
use eVisual\MCotizaciones;
use eVisual\MClientes;
use eVisual\MOrdenParametros;
use eVisual\MOrdenDetalles;
use eVisual\Custom\GenericQuerys;
use Illuminate\Support\Facades\Redirect; //para poder redireccionar
use eVisual\Http\Requests\CotizacionRequest;
use DB;

class CotizacionController extends Controller
{     
    public function index(Request $request, MClientes $cliente)
    {
        $buscar=trim($request->get('searchText'));
        $cotizaciones = MCotizaciones::select('*','cotizacion_detalle.id')
            ->leftjoin('facturas','cotizacion_detalle.id','=','facturas.id_orden')
            ->where('cotizacion_detalle.cliente_id', $cliente->id)
            ->paginate(15);           

        return view('clientes.cotizacion',compact('cliente'),
        ["cotizaciones"=>$cotizaciones,
        "searchText"=>$buscar,
        ]);        
    }

    public function create( MClientes $cliente )
    {
        $seleccionables = new GenericQuerys();
        $seleccionables = $seleccionables->seleccionables();    
        
        return view( 'clientes.cotizar', compact( 'cliente' ), [ "seleccionables" => $seleccionables ] ); 
     }
  
    public function store( CotizacionRequest $request )
    {
        $cotizacion = new MCotizaciones();
        $cotizacion->cliente_id=trim($request->input('idCliente'));
        $cotizacion->usuario_id = auth()->user()->id;
        $cotizacion->fecha= date("y-m-d");
        $cotizacion->dato0=trim($request->input('fechaEntrega'));
        $cotizacion->dato1=trim($request->input('horaEntrega'));
        $cotizacion->dato2=trim($request->input('esfera'));
        $cotizacion->dato3=trim($request->input('cilindro'));
        $cotizacion->dato4=trim($request->input('eje'));
        $cotizacion->dato5=trim($request->input('adicion'));
        $cotizacion->dato6=trim($request->input('dnp'));
        $cotizacion->dato7=trim($request->input('altura'));
        $cotizacion->dato8=trim($request->input('prisma'));
        $cotizacion->dato9=trim($request->input('lente'));
        $cotizacion->dato10=trim($request->input('lab'));
        $cotizacion->dato11=trim($request->input('nro'));
        $cotizacion->dato12=trim($request->input('bisel'));
        $cotizacion->dato13=trim($request->input('lote'));
        $cotizacion->dato14=trim($request->input('esferai'));
        $cotizacion->dato15=trim($request->input('cilindroi'));
        $cotizacion->dato16=trim($request->input('ejei'));
        $cotizacion->dato17=trim($request->input('adicioni'));
        $cotizacion->dato18=trim($request->input('dnpi'));
        $cotizacion->dato19=trim($request->input('alturai'));
        $cotizacion->dato20=trim($request->input('prismai'));
        $cotizacion->dato21=trim($request->input('lentei'));
        $cotizacion->dato22=trim($request->input('labi'));
        $cotizacion->dato23=trim($request->input('nroi'));
        $cotizacion->dato24=trim($request->input('biseli'));
        $cotizacion->dato25=trim($request->input('lotei'));
        $cotizacion->dato26=trim($request->input('tipol'));
        $cotizacion->dato27=trim($request->input('claseProgresivol'));
        $cotizacion->dato28=trim($request->input('invimal'));
        $cotizacion->dato29=trim($request->input('tratamientol'));
        $cotizacion->dato30=trim($request->input('colorLtel'));
        $cotizacion->dato31=trim($request->input('materiall'));
        $cotizacion->dato32=trim($request->input('medicol'));
        $cotizacion->dato33=trim($request->input('referenciav'));
        $cotizacion->dato34=trim($request->input('vrmonturav'));
        $cotizacion->dato35=trim($request->input('vrlentev'));
        $cotizacion->dato36=trim($request->input('totalv'));
        $cotizacion->dato37=trim($request->input('abonoinicialv'));
        $cotizacion->dato38=trim($request->input('saldov'));
        $cotizacion->dato39=trim($request->input('materialv'));
        $cotizacion->dato40=trim($request->input('--'));
        $cotizacion->dato41=trim($request->input('--'));
        $cotizacion->dato42=trim($request->input('tipov'));
        $cotizacion->dato43=trim($request->input('--'));
        $cotizacion->dato44=trim($request->input('--'));
        $cotizacion->dato45=trim($request->input('colorMontm'));
        $cotizacion->dato46=trim($request->input('horizontalm'));
        $cotizacion->dato47=trim($request->input('verticalm'));
        $cotizacion->dato48=trim($request->input('puentem'));
        $cotizacion->dato49=trim($request->input('diagonalm'));
        $cotizacion->dato50=trim($request->input('distMecanicam'));
        $cotizacion->dato51=trim($request->input('nroAlmacenm'));
        $cotizacion->dato52=trim($request->input('dVerticeODm'));
        $cotizacion->dato53=trim($request->input('dVerticeOIm'));
        $cotizacion->dato54=trim($request->input('panoramicom'));
        $cotizacion->dato55=trim($request->input('pantoscopicom'));
        $cotizacion->dato56=trim($request->input('nroRemisionm'));
        $cotizacion->dato57=trim($request->input('observaciones'));
        $cotizacion->dato59=trim($request->input('estadoCotizacion'));
        $cotizacion->dirigido=trim($request->input('dirigido'));        
        $cotizacion->save();
       
        return redirect()->route('cotizaciones.index',$cotizacion->cliente_id)->withStatus(__('Cotización Creada Sastifactoriamente.'));
    }

    public function edit(MCotizaciones $cotizacion)
    {   
        $seleccionables = new GenericQuerys();
        $seleccionables = $seleccionables->seleccionables();          
        $cliente = MClientes::find( $cotizacion->cliente_id );
        
        return view('clientes.editCotizacion',
        ["seleccionables" => $seleccionables,         
        "cotizacion" => $cotizacion,
        "cliente" => $cliente,
        ]);                                   
    }

    public function update(CotizacionRequest $request ,MCotizaciones $cotizacion)
    {
        $cotizacion->dato0=trim($request->input('fechaEntrega'));
        $cotizacion->dato1=trim($request->input('horaEntrega'));
        $cotizacion->dato2=trim($request->input('esfera'));
        $cotizacion->dato3=trim($request->input('cilindro'));
        $cotizacion->dato4=trim($request->input('eje'));
        $cotizacion->dato5=trim($request->input('adicion'));
        $cotizacion->dato6=trim($request->input('dnp'));
        $cotizacion->dato7=trim($request->input('altura'));
        $cotizacion->dato8=trim($request->input('prisma'));
        $cotizacion->dato9=trim($request->input('lente'));
        $cotizacion->dato10=trim($request->input('lab'));
        $cotizacion->dato11=trim($request->input('nro'));
        $cotizacion->dato12=trim($request->input('bisel'));
        $cotizacion->dato13=trim($request->input('lote'));
        $cotizacion->dato14=trim($request->input('esferai'));
        $cotizacion->dato15=trim($request->input('cilindroi'));
        $cotizacion->dato16=trim($request->input('ejei'));
        $cotizacion->dato17=trim($request->input('adicioni'));
        $cotizacion->dato18=trim($request->input('dnpi'));
        $cotizacion->dato19=trim($request->input('alturai'));
        $cotizacion->dato20=trim($request->input('prismai'));
        $cotizacion->dato21=trim($request->input('lentei'));
        $cotizacion->dato22=trim($request->input('labi'));
        $cotizacion->dato23=trim($request->input('nroi'));
        $cotizacion->dato24=trim($request->input('biseli'));
        $cotizacion->dato25=trim($request->input('lotei'));
        $cotizacion->dato26=trim($request->input('tipol'));
        $cotizacion->dato27=trim($request->input('claseProgresivol'));
        $cotizacion->dato28=trim($request->input('invimal'));
        $cotizacion->dato29=trim($request->input('tratamientol'));
        $cotizacion->dato30=trim($request->input('colorLtel'));
        $cotizacion->dato31=trim($request->input('materiall'));
        $cotizacion->dato32=trim($request->input('medicol'));
        $cotizacion->dato33=trim($request->input('referenciav'));
        $cotizacion->dato34=trim($request->input('vrmonturav'));
        $cotizacion->dato35=trim($request->input('vrlentev'));
        $cotizacion->dato36=trim($request->input('totalv'));
        $cotizacion->dato37=trim($request->input('abonoinicialv'));
        $cotizacion->dato38=trim($request->input('saldov'));
        $cotizacion->dato39=trim($request->input('materialv'));
        $cotizacion->dato40=trim($request->input('--'));
        $cotizacion->dato41=trim($request->input('--'));
        $cotizacion->dato42=trim($request->input('tipov'));
        $cotizacion->dato43=trim($request->input('--'));
        $cotizacion->dato44=trim($request->input('--'));
        $cotizacion->dato45=trim($request->input('colorMontm'));
        $cotizacion->dato46=trim($request->input('horizontalm'));
        $cotizacion->dato47=trim($request->input('verticalm'));
        $cotizacion->dato48=trim($request->input('puentem'));
        $cotizacion->dato49=trim($request->input('diagonalm'));
        $cotizacion->dato50=trim($request->input('distMecanicam'));
        $cotizacion->dato51=trim($request->input('nroAlmacenm'));
        $cotizacion->dato52=trim($request->input('dVerticeODm'));
        $cotizacion->dato53=trim($request->input('dVerticeOIm'));
        $cotizacion->dato54=trim($request->input('panoramicom'));
        $cotizacion->dato55=trim($request->input('pantoscopicom'));
        $cotizacion->dato56=trim($request->input('nroRemisionm'));
        $cotizacion->dato57=trim($request->input('observaciones'));
        $cotizacion->dato59=trim($request->input('estadoCotizacion'));
        $cotizacion->dirigido=trim($request->input('dirigido'));        
        $cotizacion->update();

        return redirect()->route('cotizaciones.index', $cotizacion->cliente_id)->withStatus(__('Cotización Actualizada Sastifactoriamente.'));
    }

    public function destroy(Mcotizaciones  $cotizacion)
    {
        $cotizacion->delete();

        return redirect()->route('admin.informeCotizacion')->withStatus(__('Cotizacion Eliminada Correctamente.'));
    }

    public function convertir(CotizacionRequest $request ,MCotizaciones $cotizacion) //Convertir a orden
    {
        $orden=new MOrdenDetalles();
        $orden->cliente_id = $cotizacion->cliente_id;
        $orden->usuario_id = $cotizacion->usuario_id;
        $orden->fecha = date("y-m-d");        
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
        $orden->dato40=trim($request->input('--'));
        $orden->dato41=trim($request->input('--'));
        $orden->dato42=trim($request->input('tipov'));
        $orden->dato43=trim($request->input('--'));
        $orden->dato44=trim($request->input('--'));
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
        $orden->dato59=trim($request->input('estadoCotizacion'));
        $orden->save();
        
        return redirect()->route('cotizaciones.index', $orden->cliente_id)->withStatus(__('Cotización Convertida a Orden Sastifactoriamente.'));
    }


    public function orden( MCotizaciones $cotizacion )
    {   
        $seleccionables = new GenericQuerys();
        $seleccionables = $seleccionables->seleccionables();                
        $cliente = MClientes::find($cotizacion->cliente_id);                
        $cotizacion->fecha= date("y-m-d"); //Actualizacionde fecha de la Cotizacion a converitr a la actual

        return view('clientes.cotizacionOrden',
        ["seleccionables"=>$seleccionables,
        "cotizacion"=>$cotizacion,
        "cliente"=>$cliente,
        ]);                           
    }
}
