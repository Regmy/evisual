<?php

namespace eVisual\Http\Controllers;

use Illuminate\Http\Request;
use eVisual\MGarantias;
use eVisual\MClientes;
use eVisual\MOrdenParametros;
use eVisual\MOrdenDetalles;
use Illuminate\Support\Facades\Redirect; //para poder redireccionar
use eVisual\Http\Requests\GarantiaRequest;
use DB;

class GarantiaController extends Controller
{
     /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request, MClientes $cliente)
    {
            /*$garantiaes=DB::table('cotizacion_detalle')->where('cliente_id','=',$cliente->id)
            ->orderBy('dato0','desc')->paginate(15);
            echo count($garantiaes);
            */
           $garantias = MGarantias::select('garantia_detalle.id', 'garantia_detalle.fecha', 'garantia_detalle.dato58', 'facturas.id_orden','garantia_detalle.id_orden_in','garantia_detalle.id_orden_out')
             ->leftjoin('facturas','garantia_detalle.id','=','facturas.id_orden')
             ->where('garantia_detalle.cliente_id','=',$cliente->id)
             ->paginate(15);

             //dd($garantiaes);
            $buscar=trim($request->get('searchText'));
            return view('clientes.garantias',compact('cliente'),
            ["garantias"=>$garantias,
             "searchText"=>$buscar,
             ]);
        
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create(MOrdenDetalles $orden)
    {                
        //Parametros de esferas
        $esfera=DB::table('ordenes_parametros')->where('campo','=','formula_OD_esfera')->get();
        $esfera=$esfera->toJson();
        $esfera=json_decode($esfera, true);
        //Parametros de cilindros
        $cilindro=DB::table('ordenes_parametros')->where('campo','=','formula_OD_cilindro')->get();
        $cilindro=$cilindro->toJson();
        $cilindro=json_decode($cilindro, true);
        //Parametros de adicion
        $adicion=DB::table('ordenes_parametros')->where('campo','=','formula_OD_adicion')->get();
        $adicion=$adicion->toJson();
        $adicion=json_decode($adicion, true);
        //Parametros de lente
        $lente=DB::table('ordenes_parametros')->where('campo','=','formula_OD_lente')->get();
        $lente=$lente->toJson();
        $lente=json_decode($lente, true);
        //Parametros de lab
        $lab=DB::table('ordenes_parametros')->where('campo','=','formula_OI_lab')->get();
        $lab=$lab->toJson();
        $lab=json_decode($lab, true);
        //Parametros de bisel
        $bisel=DB::table('ordenes_parametros')->where('campo','=','formula_OI_bisel')->get();
        $bisel=$bisel->toJson();
        $bisel=json_decode($bisel, true);
        //Parametros de tipol
        $tipol=DB::table('ordenes_parametros')->where('campo','=','lente_tipo')->get();
        $tipol=$tipol->toJson();
        $tipol=json_decode($tipol, true);
        //Parametros de tratamientol
        $tratamientol=DB::table('ordenes_parametros')->where('campo','=','lente_tratamiento')->get();
        $tratamientol=$tratamientol->toJson();
        $tratamientol=json_decode($tratamientol, true);
        //Parametros de claseProgresivol
        $claseProgresivol=DB::table('ordenes_parametros')->where('campo','=','lente_clase_de_progresivo')->get();
        $claseProgresivol=$claseProgresivol->toJson();
        $claseProgresivol=json_decode($claseProgresivol, true);
        //Parametros de colorLtel
        $colorLtel=DB::table('ordenes_parametros')->where('campo','=','color_lte')->get();
        $colorLtel=$colorLtel->toJson();
        $colorLtel=json_decode($colorLtel, true);
        //Parametros de materiall
        $materiall=DB::table('ordenes_parametros')->where('campo','=','lente_material')->get();
        $materiall=$materiall->toJson();
        $materiall=json_decode($materiall, true);
        //Parametros de medicol
        $medicol=DB::table('ordenes_parametros')->where('campo','=','medico')->get();
        $medicol=$medicol->toJson();
        $medicol=json_decode($medicol, true);
        //Parametros de colorMontm
        $colorMontm=DB::table('ordenes_parametros')->where('campo','=','color_mont')->get();
        $colorMontm=$colorMontm->toJson();
        $colorMontm=json_decode($colorMontm, true);
        
        //Cliente
        $cliente=new Mclientes();
        $cliente =$cliente::find($orden->cliente_id);
        $idOrden = $orden->id;

        $garantia = $orden;

        return view('clientes.ordenGarantia',compact('garantia'),
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
        "cliente"=>$cliente,
        "idOrden"=>$idOrden,
        ]); 
     }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GarantiaRequest $request)
    {
        $garantia=new MGarantias();
        $garantia->cliente_id=trim($request->input('idCliente'));;
        $garantia->fecha= date("y-m-d");
        $garantia->dato0=trim($request->input('fechaEntrega'));
        $garantia->dato1=trim($request->input('horaEntrega'));
        $garantia->dato2=trim($request->input('esfera'));
        $garantia->dato3=trim($request->input('cilindro'));
        $garantia->dato4=trim($request->input('eje'));
        $garantia->dato5=trim($request->input('adicion'));
        $garantia->dato6=trim($request->input('dnp'));
        $garantia->dato7=trim($request->input('altura'));
        $garantia->dato8=trim($request->input('prisma'));
        $garantia->dato9=trim($request->input('lente'));
        $garantia->dato10=trim($request->input('lab'));
        $garantia->dato11=trim($request->input('nro'));
        $garantia->dato12=trim($request->input('bisel'));
        $garantia->dato13=trim($request->input('lote'));
        $garantia->dato14=trim($request->input('esferai'));
        $garantia->dato15=trim($request->input('cilindroi'));
        $garantia->dato16=trim($request->input('ejei'));
        $garantia->dato17=trim($request->input('adicioni'));
        $garantia->dato18=trim($request->input('dnpi'));
        $garantia->dato19=trim($request->input('alturai'));
        $garantia->dato20=trim($request->input('prismai'));
        $garantia->dato21=trim($request->input('lentei'));
        $garantia->dato22=trim($request->input('labi'));
        $garantia->dato23=trim($request->input('nroi'));
        $garantia->dato24=trim($request->input('biseli'));
        $garantia->dato25=trim($request->input('lotei'));
        $garantia->dato26=trim($request->input('tipol'));
        $garantia->dato27=trim($request->input('claseProgresivol'));
        $garantia->dato28=trim($request->input('invimal'));
        $garantia->dato29=trim($request->input('tratamientol'));
        $garantia->dato30=trim($request->input('colorLtel'));
        $garantia->dato31=trim($request->input('materiall'));
        $garantia->dato32=trim($request->input('medicol'));
        $garantia->dato33=trim($request->input('referenciav'));
        $garantia->dato34=trim($request->input('vrmonturav'));
        $garantia->dato35=trim($request->input('vrlentev'));
        $garantia->dato36=trim($request->input('totalv'));
        $garantia->dato37=trim($request->input('abonoinicialv'));
        $garantia->dato38=trim($request->input('saldov'));
        $garantia->dato39=trim($request->input('materialv'));
        $garantia->dato40=trim($request->input('--'));
        $garantia->dato41=trim($request->input('--'));
        $garantia->dato42=trim($request->input('tipov'));
        $garantia->dato43=trim($request->input('--'));
        $garantia->dato44=trim($request->input('--'));
        $garantia->dato45=trim($request->input('colorMontm'));
        $garantia->dato46=trim($request->input('horizontalm'));
        $garantia->dato47=trim($request->input('verticalm'));
        $garantia->dato48=trim($request->input('puentem'));
        $garantia->dato49=trim($request->input('diagonalm'));
        $garantia->dato50=trim($request->input('distMecanicam'));
        $garantia->dato51=trim($request->input('nroAlmacenm'));
        $garantia->dato52=trim($request->input('dVerticeODm'));
        $garantia->dato53=trim($request->input('dVerticeOIm'));
        $garantia->dato54=trim($request->input('panoramicom'));
        $garantia->dato55=trim($request->input('pantoscopicom'));
        $garantia->dato56=trim($request->input('nroRemisionm'));
        $garantia->dato57=trim($request->input('observaciones'));
        $garantia->dato58=trim($request->input('usuarioActivo'));
        $garantia->dato59=trim($request->input('estadoGarantia'));       
        $garantia->id_orden_in=trim($request->input('idOrden'));       
        // $garantia->id_orden_out=trim($request->input(''));       
        $garantia->save();
       
        /*$garantia->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        */
        return redirect()->route('garantias.index',$garantia->cliente_id)->withStatus(__('Orden Convertida a Garantía Sastifactoriamente.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(MGarantias $garantia)
    {   
        //Parametros de esferas
        $esfera=DB::table('ordenes_parametros')->where('campo','=','formula_OD_esfera')->get();
        $esfera=$esfera->toJson();
        $esfera=json_decode($esfera, true);
        //Parametros de cilindros
        $cilindro=DB::table('ordenes_parametros')->where('campo','=','formula_OD_cilindro')->get();
        $cilindro=$cilindro->toJson();
        $cilindro=json_decode($cilindro, true);
        //Parametros de adicion
        $adicion=DB::table('ordenes_parametros')->where('campo','=','formula_OD_adicion')->get();
        $adicion=$adicion->toJson();
        $adicion=json_decode($adicion, true);
        //Parametros de lente
        $lente=DB::table('ordenes_parametros')->where('campo','=','formula_OD_lente')->get();
        $lente=$lente->toJson();
        $lente=json_decode($lente, true);
        //Parametros de lab
        $lab=DB::table('ordenes_parametros')->where('campo','=','formula_OI_lab')->get();
        $lab=$lab->toJson();
        $lab=json_decode($lab, true);
        //Parametros de bisel
        $bisel=DB::table('ordenes_parametros')->where('campo','=','formula_OI_bisel')->get();
        $bisel=$bisel->toJson();
        $bisel=json_decode($bisel, true);
        //Parametros de tipol
        $tipol=DB::table('ordenes_parametros')->where('campo','=','lente_tipo')->get();
        $tipol=$tipol->toJson();
        $tipol=json_decode($tipol, true);
        //Parametros de tratamientol
        $tratamientol=DB::table('ordenes_parametros')->where('campo','=','lente_tratamiento')->get();
        $tratamientol=$tratamientol->toJson();
        $tratamientol=json_decode($tratamientol, true);
        //Parametros de claseProgresivol
        $claseProgresivol=DB::table('ordenes_parametros')->where('campo','=','lente_clase_de_progresivo')->get();
        $claseProgresivol=$claseProgresivol->toJson();
        $claseProgresivol=json_decode($claseProgresivol, true);
        //Parametros de colorLtel
        $colorLtel=DB::table('ordenes_parametros')->where('campo','=','color_lte')->get();
        $colorLtel=$colorLtel->toJson();
        $colorLtel=json_decode($colorLtel, true);
        //Parametros de materiall
        $materiall=DB::table('ordenes_parametros')->where('campo','=','lente_material')->get();
        $materiall=$materiall->toJson();
        $materiall=json_decode($materiall, true);
        //Parametros de medicol
        $medicol=DB::table('ordenes_parametros')->where('campo','=','medico')->get();
        $medicol=$medicol->toJson();
        $medicol=json_decode($medicol, true);
        //Parametros de colorMontm
        $colorMontm=DB::table('ordenes_parametros')->where('campo','=','color_mont')->get();
        $colorMontm=$colorMontm->toJson();
        $colorMontm=json_decode($colorMontm, true);

        
        //Cliente
        // $cliente=new Mclientes();
        $cliente =Mclientes::find($garantia->cliente_id);
        
        //dd($parametros);
        return view('clientes.editGarantia',
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
        "garantia"=>$garantia,
        "cliente"=>$cliente,
        ]);                           
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GarantiaRequest $request ,MGarantias $garantia)
    {
        //dd($garantia);
        //$garantia->cliente_id=trim($request->input('idCliente'));;
        //$garantia->fecha= date("y-m-d");        
        $garantia->dato0=trim($request->input('fechaEntrega'));
        $garantia->dato1=trim($request->input('horaEntrega'));
        $garantia->dato2=trim($request->input('esfera'));
        $garantia->dato3=trim($request->input('cilindro'));
        $garantia->dato4=trim($request->input('eje'));
        $garantia->dato5=trim($request->input('adicion'));
        $garantia->dato6=trim($request->input('dnp'));
        $garantia->dato7=trim($request->input('altura'));
        $garantia->dato8=trim($request->input('prisma'));
        $garantia->dato9=trim($request->input('lente'));
        $garantia->dato10=trim($request->input('lab'));
        $garantia->dato11=trim($request->input('nro'));
        $garantia->dato12=trim($request->input('bisel'));
        $garantia->dato13=trim($request->input('lote'));
        $garantia->dato14=trim($request->input('esferai'));
        $garantia->dato15=trim($request->input('cilindroi'));
        $garantia->dato16=trim($request->input('ejei'));
        $garantia->dato17=trim($request->input('adicioni'));
        $garantia->dato18=trim($request->input('dnpi'));
        $garantia->dato19=trim($request->input('alturai'));
        $garantia->dato20=trim($request->input('prismai'));
        $garantia->dato21=trim($request->input('lentei'));
        $garantia->dato22=trim($request->input('labi'));
        $garantia->dato23=trim($request->input('nroi'));
        $garantia->dato24=trim($request->input('biseli'));
        $garantia->dato25=trim($request->input('lotei'));
        $garantia->dato26=trim($request->input('tipol'));
        $garantia->dato27=trim($request->input('claseProgresivol'));
        $garantia->dato28=trim($request->input('invimal'));
        $garantia->dato29=trim($request->input('tratamientol'));
        $garantia->dato30=trim($request->input('colorLtel'));
        $garantia->dato31=trim($request->input('materiall'));
        $garantia->dato32=trim($request->input('medicol'));
        $garantia->dato33=trim($request->input('referenciav'));
        $garantia->dato34=trim($request->input('vrmonturav'));
        $garantia->dato35=trim($request->input('vrlentev'));
        $garantia->dato36=trim($request->input('totalv'));
        $garantia->dato37=trim($request->input('abonoinicialv'));
        $garantia->dato38=trim($request->input('saldov'));
        $garantia->dato39=trim($request->input('materialv'));
        $garantia->dato40=trim($request->input('--'));
        $garantia->dato41=trim($request->input('--'));
        $garantia->dato42=trim($request->input('tipov'));
        $garantia->dato43=trim($request->input('--'));
        $garantia->dato44=trim($request->input('--'));
        $garantia->dato45=trim($request->input('colorMontm'));
        $garantia->dato46=trim($request->input('horizontalm'));
        $garantia->dato47=trim($request->input('verticalm'));
        $garantia->dato48=trim($request->input('puentem'));
        $garantia->dato49=trim($request->input('diagonalm'));
        $garantia->dato50=trim($request->input('distMecanicam'));
        $garantia->dato51=trim($request->input('nroAlmacenm'));
        $garantia->dato52=trim($request->input('dVerticeODm'));
        $garantia->dato53=trim($request->input('dVerticeOIm'));
        $garantia->dato54=trim($request->input('panoramicom'));
        $garantia->dato55=trim($request->input('pantoscopicom'));
        $garantia->dato56=trim($request->input('nroRemisionm'));
        $garantia->dato57=trim($request->input('observaciones'));
        //$garantia->dato58=trim($request->input('usuarioActivo'));
        $garantia->dato59=trim($request->input('estadoGarantia'));      
        // $garantia->id_orden_in=trim($request->input('idOrden'));      
        //dd($garantia);
        $garantia->update();
        
        
        /*$user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));*/

        return redirect()->route('garantias.index', $garantia->cliente_id)->withStatus(__('Garantía Actualizada Sastifactoriamente.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MGarantias $garantia)
    {
        $garantia->delete();

        return redirect()->route('admin.informeGarantia')->withStatus(__('Garantía Eliminada Correctamente.'));
    }

    //Convertir a orden
    public function convertirOrden(MGarantias $garantia)
    {
        dd('En construcción');
        dd($garantia->usuario->id);
        $orden=new MOrdenDetalles();
        $orden->cliente_id=$garantia->cliente_id;
        $orden->usuario_id=$garantia->usuario_id;
        $orden->fecha= date("y-m-d");        
        $orden->dato0= $garantia->dato0;
        $orden->dato1= $garantia->dato1;
        $orden->dato2= $garantia->dato2;
        $orden->dato3= $garantia->dato3;
        $orden->dato4= $garantia->dato4;
        $orden->dato5= $garantia->dato5;
        $orden->dato6= $garantia->dato6;
        $orden->dato7= $garantia->dato7;
        $orden->dato8= $garantia->dato8;
        $orden->dato9= $garantia->dato9;
        $orden->dato10= $garantia->dao10;
        $orden->dato11= $garantia->dato11;
        $orden->dato12= $garantia->dato12;
        $orden->dato13= $garantia->dato13;
        $orden->dato14= $garantia->dato14;
        $orden->dato15= $garantia->dato15;
        $orden->dato16= $garantia->dato16;
        $orden->dato17= $garantia->dato17;
        $orden->dato18= $garantia->dato18;
        $orden->dato19= $garantia->dato19;
        $orden->dato20= $garantia->dato20;
        $orden->dato21= $garantia->dato21;
        $orden->dato22= $garantia->dato22;
        $orden->dato23= $garantia->dato23;
        $orden->dato24= $garantia->dato24;
        $orden->dato25= $garantia->dato25;
        $orden->dato26= $garantia->dato26;
        $orden->dato27= $garantia->dato27;
        $orden->dato28= $garantia->dato28;
        $orden->dato29= $garantia->dato29;
        $orden->dato30= $garantia->dato30;
        $orden->dato31= $garantia->dato31;
        $orden->dato32= $garantia->dato32;
        $orden->dato33= $garantia->dato33;
        $orden->dato34= $garantia->dato34;
        $orden->dato35= $garantia->dato35;
        $orden->dato36= $garantia->dato36;
        $orden->dato37= $garantia->dato37;
        $orden->dato38= $garantia->dato38;
        $orden->dato39= $garantia->dato39;
        $orden->dato40= $garantia->dato40;
        $orden->dato41= $garantia->dato41;
        $orden->dato42= $garantia->dato42;
        $orden->dato43= $garantia->dato43;
        $orden->dato44= $garantia->dato44;
        $orden->dato45= $garantia->dato45;
        $orden->dato46= $garantia->dato46;
        $orden->dato47= $garantia->dato47;
        $orden->dato48= $garantia->dato48;
        $orden->dato49= $garantia->dato49;
        $orden->dato50= $garantia->dato50;
        $orden->dato51= $garantia->dato51;
        $orden->dato52= $garantia->dato52;
        $orden->dato53= $garantia->dato53;
        $orden->dato54= $garantia->dato54;
        $orden->dato55= $garantia->dato55;
        $orden->dato56= $garantia->dato56;
        $orden->dato57= $garantia->dato57;
        $orden->dato58= $garantia->dato58;
        $orden->dato59= $garantia->dato59;
        $orden->nro_fact= "";
        $orden->curva_base= "";        
        $orden->save();

        //Almacenando el id de la orden creada en base a la garantía.
        $garantia->id_orden_out = $orden->id;
        $garantia->update();

        return redirect()->route('garantias.index', $garantia->cliente_id)->withStatus(__('Garantía Convertida a Orden Sastifactoriamente.'));
    }
}
