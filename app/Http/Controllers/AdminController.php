<?php

namespace eVisual\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use eVisual\MClientes;
use eVisual\MFacturaRango;
use eVisual\MOrdenDetalles;
use eVisual\MOrdenParametros;
use eVisual\MBodegas;
use eVisual\User;
use eVisual\Custom\GenericQuerys;
use eVisual\Http\Requests\FacturaRangoRequest;
use eVisual\Http\Requests\ParametrosRequest;
use eVisual\Http\Requests\BodegaRequest;
//excel
use eVisual\Exports\CarteraExport;
use eVisual\Exports\FiltroExport;
use eVisual\Exports\GarantiaExport;
use eVisual\Exports\CotizacionExport;
use eVisual\Exports\TotalMesExport;
use eVisual\Exports\ConsolidadoClienteExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    function indexAdmin(string $page)
    {
        if (view()->exists("admin.{$page}")) {
            return view("admin.{$page}");
        }

        return abort(404);
    } 
    
    function indexInforme(string $page)
    {
        if (view()->exists("admin.informe.{$page}")) {
            return view("admin.informe.{$page}");
        }

        return abort(404);
    } 

    function clientesConsolidado( Request $request )
    {      
        $fechaInicio = $request->get( 'fechaInicio' );     
        $fechaFin = $request->get( 'fechaFin' );
        $data = $request->all();

        if ( $fechaInicio == "" ) {
            $fechaActual = date( "y-m-d" );
            $fechaInicio = date( "y-m-d", strtotime( $fechaActual."- 1 year" ));
        }
        if( $fechaFin == "" ){
            $fechaFin=date("y-m-d");
        }
        $clientes = MClientes::select( '*' )->whereBetween( 'dato10', [ $fechaInicio, $fechaFin ] )->orderBy( 'id', 'desc' );

        //Export Excel 
        if( $request->input( "excelCheck" ) == "1" ){
            $clientes = $clientes->get();
            $fechaExcel = date( "y-m-d" );
            return Excel::download( new ConsolidadoClienteExport( $clientes ), '('.$fechaExcel.') ConsolidadoClientes.xlsx' );
        }
        else{
            $clientes = $clientes->paginate(100);
        }
        //Acondicionamiento de la variable de Conteo de Fltros.
        if (count( $clientes ) == 100 ){
            $cantidadFiltrados = $clientes->total();
        }
        else{            
            $cantidadFiltrados = count( $clientes );
        }

        return view( 'admin.clientesConsolidado',
        [   "clientes" => $clientes,
            "fechaInicio" => $fechaInicio,
            "fechaFin" => $fechaFin,
            "data" => $data,
            ]);        
    }

    function cartera( Request $request )
    {    
        $data = $request->all();  
        $buscar = trim( $request->get('searchText' ) );        
        $ordenes = DB::table( 'orden_detalle as a' ) //Pasar a Eloquet esta Consulta
        ->join( 'clientes as b','b.id','=','a.cliente_id' )
        ->select( 'a.id as orden_id','a.fecha as orden_fechaElaboracion',
        'a.dato0 as orden_fechaEntrega', 'a.dato58 as orden_usuario','a.dato59 as orden_estado'
        ,'a.dato36 as orden_total','a.dato37 as orden_abonos','b.dato1 as cliente_nombre',
        'b.dato2 as cliente_documento','b.dato3 as cliente_contacto' )
        ->where( 'a.dato36','!=','a.dato37' )
        ->orderBy( 'orden_id')->paginate( 100 );            

        return view( 'admin.cartera',
        ["ordenes" => $ordenes,
        "searchText" => $buscar,
        "data" => $data,
        ]);        
    }

    function carteraExcel( Request $request ){

        $fechaExcel = date( "y-m-d" );
        $ordenes = DB::table( 'orden_detalle as a' )   //Pasar a Eloquet esta Consulta
        ->join( 'clientes as b','b.id','=','a.cliente_id' )
        ->select( 'a.id as orden_id','a.fecha as orden_fechaElaboracion',
        'a.dato0 as orden_fechaEntrega', 'a.dato58 as orden_usuario','a.dato59 as orden_estado'
        ,'a.dato36 as orden_total','a.dato37 as orden_abonos','b.dato1 as cliente_nombre',
        'b.dato2 as cliente_documento','b.dato3 as cliente_contacto' )
        ->where( 'a.dato36','!=','a.dato37' )
        ->orderBy( 'orden_id')
        ->get();
        
        return Excel::download( new CarteraExport( $ordenes ),'('.$fechaExcel.') Cartera.xlsx' );
    }
    //---------------------------------------BODEGA-----------------------------------------------------------    
    function bodega( Request $request )
    {       
        $buscar = trim( $request->get( 'searchText' ) ); //Crear un codigo de busqueda
        $bodegas = DB::table( 'bodega' )->select( '*' )->orderBy( 'id_bdg','desc' )->paginate( 100 ); // Pasar esta Consulta a Eloquent

        return view( 'admin.bodega', [ "bodegas" => $bodegas, "searchText" => $buscar, ] );        
    }

    function createBodega()
    {
        return view( 'admin.createBodega' );
    }

    function editBodega( MBodegas $bodega )
    {
        return view( 'admin.editBodega', [ "bodega" => $bodega ] );
    }

    function storeBodega( BodegaRequest $request )
    {    
        $bodega = new Mbodegas();
        $bodega->cantidad = trim( $request->input( 'cantidad' ) );
        $bodega->bodega = trim( $request->input( 'bodega' ) );
        $bodega->referencia = trim( $request->input( 'referencia' ) );
        $bodega->codigo = trim( $request->input('codigo'));
        $bodega->grupo_familia = trim( $request->input( 'grupoFamilia' ) );
        $bodega->marca = trim( $request->input( 'marca' ) );
        $bodega->manifiesto = trim( $request->input( 'manifiesto' ) );
        $bodega->costo = trim( $request->input( 'costo' ) );
        $bodega->precio = trim( $request->input( 'precio' ) );
        $bodega->tipo = trim( $request->input( 'tipo' ) );
        $bodega->material = trim( $request->input( 'material' ) );
        $bodega->unidad_de_medida = trim( $request->input( 'unidadMedida') ) ;
        $bodega->invima = trim( $request->input( 'invima' ) );  
        $bodega->lote = trim( $request->input( 'lote' ) );  
        $bodega->color = trim( $request->input( 'color' ) );       
        $bodega->save();
              
        return redirect()->route(' admin.bodega' )->withStatus(__( 'Bodega Agregada Sastifactoriamente' ) );
    }

    function updateBodega( BodegaRequest $request, Mbodegas $bodega )
    {    
        $bodega->cantidad = trim( $request->input( 'cantidad' ) );
        $bodega->bodega = trim( $request->input( 'bodega' ) );
        $bodega->referencia = trim( $request->input( 'referencia' ) );
        $bodega->codigo = trim( $request->input( 'codigo' ) );
        $bodega->grupo_familia = trim( $request->input( 'grupoFamilia' ) );
        $bodega->marca = trim( $request->input( 'marca' ) );
        $bodega->manifiesto = trim( $request->input( 'manifiesto' ) );
        $bodega->costo = trim( $request->input( 'costo' ) );
        $bodega->precio = trim( $request->input( 'precio' ) );
        $bodega->tipo = trim( $request->input( 'tipo' ) );
        $bodega->material = trim( $request->input( 'material' ) );
        $bodega->unidad_de_medida = trim( $request->input( 'unidadMedida' ) );
        $bodega->invima = trim( $request->input( 'invima' ) );  
        $bodega->lote = trim( $request->input( 'lote' ) );  
        $bodega->color = trim( $request->input( 'color' ) );       
        $bodega->update();
              
        return redirect()->route( 'admin.bodega' )->withStatus(__( 'Bodega Actualizada Sastifactoriamente' ) );
    }

    function deleteBodega( MBodegas $bodega )
    {
        $bodega->delete();

        return redirect()->route( 'admin.bodega' )->withStatus(__( 'Bodega Eliminada Sastifactoriamente' ) );
    }
    //------------------------------------------SEDE--------------------------------------------------------
    function sede( Request $request )
    {
        $facturaRangos = MFacturaRango::select( '*' )->orderBy( 'id','desc' )->paginate( 100 );

        return view( 'admin.sede', [ "facturaRangos"=>$facturaRangos ] ); 
     }

    function createFacturaRango()
    {               
        return view( 'admin.createFacturaRango' );
    }

    function storeFacturaRango( FacturaRangoRequest $request )
    {        
        $statusMessage = 'Sede Agregada Sastifactoriamente'; //Variable del mensaje por defecto
        $facturaRango = new MFacturaRango();
        $facturaRango->sede = trim($request->input('sede') ); 
        $facturaRango->inicio = trim( $request->input( 'inicio' ) );
        $facturaRango->fin = trim($request->input( 'fin' )) ;
        $facturaRango->texto = trim( $request->input( 'texto' ) );
        $facturaRango->prefijo = trim($request->input( 'prefijo' ) );
        $facturaRango->resolucion = trim( $request->input( 'resolucion' ) );
        $facturaRango->iva = trim($request->input( 'iva' ) );
        $facturaRango->rango_rc_inicio = trim( $request->input( 'rangoInicio' ) );
        $facturaRango->rango_rc_fin = trim($request->input( 'rangoFin' ) );        
        //Tratamiento de la imagen                
        if( $request->file( 'imagenLogo' ) && $request->file( 'imagenDatos' ) ){ //Verifica si se enviaron las dos imagenes            
            //Optiene los nombres originales de las imagenes y se almacena
            $nameLogo = $request->file( 'imagenLogo')->getClientOriginalName();
            $nameDatos = $request->file('imagenDatos')->getClientOriginalName();
            if(Storage::disk('facturas')->exists('/facturas/'.$nameLogo) || Storage::disk('facturas')->exists('/facturas/'.$nameDatos)){ // Verifica si ya existen                
                return redirect()->route('admin.createFacturaRango')->with('badStatus','Sede NO agregada " Los nombres de una o ambas imagenes ya existen en el directorio,
                se recomienda Cambiar los nombres de los archivos antes de subirlos."');
            }
            else{                 
                 //Se guardan en el Disk Facturas "filesystem.php" ubicado e "config" 
                 $path1= Storage::disk('facturas')->putFileAs('facturas',$request->file('imagenLogo'), $nameLogo);
                 $path2= Storage::disk('facturas')->putFileAs('facturas',$request->file('imagenDatos'), $nameDatos);
                 //Se almacena los nombres en el arreglo para enviarlo a la DB.
                 $facturaRango->imagen_logo = $nameLogo;
                 $facturaRango->imagen_datos = $nameDatos;                 
            }        
        }
        else{ 
            //Guarda por defecto "En caso de que no se Seleccione ninguna imagen de Logo o Datos.
            $facturaRango->imagen_logo = 'logo_EV.png';
            $facturaRango->imagen_datos = 'default_Logo_Datos.jpeg';
            $statusMessage = 'Sede Agregada Sastifactoriamente, Se aplicaron ambas imagenes "Por defecto".
            Debido a que No seleccionó ninguna';

            if($request->file('imagenLogo')){ // Si solo se seleccionó la "imagenLogo".
                //Optiene los nombres originales de las imagenes y se almacena
                $nameLogo = $request->file('imagenLogo')->getClientOriginalName();
                //Se guardan en el Disk Facturas "filesystem.php" ubicado e "config" 
                $path1= Storage::disk('facturas')->putFileAs('facturas',$request->file('imagenLogo'), $nameLogo);
                $facturaRango->imagen_logo = $nameLogo;
                $statusMessage = 'Sede Agregada Sastifactoriamente, Se aplicó la Imagen de Datos "Por defecto".
                Debido a que No seleccionó ninguna';
            }
            if($request->file('imagenDatos')){ // Si solo se seleccionó la "imagenDatos".
                //Optiene los nombres originales de las imagenes y se almacena
                $nameLogo = $request->file('imagenDatos')->getClientOriginalName();
                //Se guardan en el Disk Facturas "filesystem.php" ubicado e "config" 
                $path2= Storage::disk('facturas')->putFileAs('facturas',$request->file('imagenDatos'), $nameDatos);
                $facturaRango->imagen_datos = $nameDatos;
                $statusMessage = 'Sede Agregada Sastifactoriamente, Se aplicó la Imagen de Logo "Por defecto".
                Debido a que No seleccionó ninguna';
            }            
        }
        $facturaRango->texto_devolucion=trim($request->input('textoDevolucion'));
        $facturaRango->texto_horarios=trim($request->input('textoHorarios')); 
        $facturaRango->save(); 

        return redirect()->route('admin.sede')->withStatus($statusMessage);
    }
    
    function editFacturaRango(MFacturaRango $facturaRango)
    {
        return view( 'admin.editFacturaRango', [ "facturaRango" =>$facturaRango ] );
    }

    function updateFacturaRango(FacturaRangoRequest $request, MFacturaRango $facturaRango)
    {    
        $facturaRango->sede=trim($request->input('sede'));
        $facturaRango->inicio=trim($request->input('inicio'));
        $facturaRango->fin=trim($request->input('fin'));
        $facturaRango->texto=trim($request->input('texto'));
        $facturaRango->prefijo=trim($request->input('prefijo'));
        $facturaRango->resolucion=trim($request->input('resolucion'));
        $facturaRango->iva=trim($request->input('iva'));
        $facturaRango->rango_rc_inicio=trim($request->input('rangoInicio'));
        $facturaRango->rango_rc_fin=trim($request->input('rangoFin'));
        //Tratamiento de la imagen        
        if($request->file('imagenLogo')){   //Verifica si se enviaron las dos imagenes
             //Optiene los nombres originales de las imagenes y se almacena
            $nameLogo = $request->file('imagenLogo')->getClientOriginalName();
            
            if(Storage::disk('facturas')->exists('/facturas/'.$nameLogo)){ // Verifica si ya existen                
                Storage::disk('facturas')->delete('/facturas/'.$facturaRango->imagen_logo);                                              
            }
            //Se guardan en el Disk Facturas "filesystem.php" ubicado e "config" 
            $path1= Storage::disk('facturas')->putFileAs('facturas',$request->file('imagenLogo'), $nameLogo);
            $facturaRango->imagen_logo = $nameLogo;
        }

        if($request->file('imagenDatos')){  //Verifica si se enviaron las dos imagenes
            //Optiene los nombres originales de las imagenes y se almacena           
            $nameDatos = $request->file('imagenDatos')->getClientOriginalName();            
            
            if(Storage::disk('facturas')->exists('/facturas/'.$nameDatos)){
                Storage::disk('facturas')->delete('/facturas/'.$facturaRango->imagen_datos); 
            }                             
            //Se guardan en el Disk Facturas "filesystem.php" ubicado e "config"             
            $path2= Storage::disk('facturas')->putFileAs('facturas',$request->file('imagenDatos'), $nameDatos);
            //Se almacena los nombres en el arreglo para enviarlo a la DB            
            $facturaRango->imagen_datos= $nameDatos;              
        }

        $facturaRango->texto_devolucion=trim($request->input('textoDevolucion'));
        $facturaRango->texto_horarios=trim($request->input('textoHorarios')); 
        $facturaRango->update();   

        return redirect()->route('admin.sede')->withStatus(__('Sede Actualizada Sastifactoriamente'));
    }
    
    function deleteFacturaRango(MFacturaRango $facturaRango)
    {
        // Condicionales para evitar la eliminacion de la imagen por defecto.
        if( $facturaRango->imagen_logo != 'logo_EV.png'){
            Storage::disk('facturas')->delete('/facturas/'.$facturaRango->imagen_logo);                                
        }
        if( $facturaRango->imagen_datos != 'default_Logo_Datos.jpeg'){            
            Storage::disk('facturas')->delete('/facturas/'.$facturaRango->imagen_datos);
        }
        //-------
        $facturaRango->delete();
        return redirect()->route('admin.sede')->withStatus(__('Sede Eliminada Sastifactoriamente'));
    }

    //---------------------------------------Seleccionables-----------------------------------------------------------

    function seleccionables()
    {   
        $totalTotal = 0;
        $seleccionables = new GenericQuerys();
        $seleccionables = $seleccionables -> seleccionables();
        
        return view('admin.seleccionables',
        [ "seleccionables" => $seleccionables, "totalTotal" => $totalTotal ] );                          
    }
    
    function createSeleccionables(ParametrosRequest $request)
    {
        $parametro = new MOrdenParametros();
        $parametro->campo=trim($request->input('seleccion'));
        $parametro->option_value=trim($request->input('newSeleccion'));      
        $parametro->save();
              
        return redirect()->route('admin.seleccionables')->withStatus(__('Seleccionable: ' . "'".$parametro->option_value. "'". ' Agregado Sastifactoriamente'));
    }

    function deleteSeleccionables(MOrdenParametros $seleccionable)
    {
        $seleccionable->delete();

        return redirect()->route('admin.seleccionables')->withStatus(__('Seleccionable: ' . "'".$seleccionable->option_value. "'". ' Eliminado Sastifactoriamente'));
    }

    //----------------------------------------Informe Filtro----------------------------------------------------------
    
    function informeFiltro(Request $request)
    {   
        dd('En construcción');
        $total['total']     =0;
        $total['abono']     =0;
        $total['saldo']     =0;
        $total['montura']   =0;
        $total['lente']     =0;
        $data               = $request->all(); 
        $usuarios           = User::all();
        $sedes              = MFacturaRango::all();
        $seleccionables     = new GenericQuerys();
        $seleccionables     = $seleccionables -> seleccionables();
                   
        if ( empty( $data ) ){
            $ordenes = MOrdenDetalles::where('id','a');   
            /* $ordenes=DB::table('orden_detalle as orden')  //Pasar a Eloquent 
            ->select('u.*','orden.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion',
            'c.dato11 as c_sede','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','orden.dato58')
            ->leftjoin('clientes as c','c.id','=','orden.cliente_id')
            ->where('u.id','9999999')
            ->orderBy('orden.fecha'); */           
        }
        else{              
            /* $ordenes=DB::table('orden_detalle as orden')
            ->select('u.*','orden.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','orden.dato58')
            ->leftjoin('clientes as c','c.id','=','orden.cliente_id') */
            //Filtro por Fecha de Pedido
            $ordenes = MOrdenDetalles::when($request->input('fechaInicioPedido'), function($query) use ($request){
                if (is_null($request->input('fechaFinPedido'))){                
                    $fecha=date("y-m-d");                        
                }
                else{
                    $fecha= $request->input('fechaFinPedido');
                }
                $query->where('fecha','>=',$request->get('fechaInicioPedido'))
                ->where('fecha','<=',$fecha);
            })
            ->when($request->input('fechaFinPedido'), function($query) use ($request){ 
                if (is_null($request->input('fechaInicioPedido'))){ 
                    $fecha= date("y-m-d",strtotime($request->input('fechaInicioPedido')."- 1 year"));                       
                }
                else{
                    $fecha= $request->input('fechaInicioPedido');
                }
                $query->where('fecha','>=',$fecha)
                ->where('fecha','<=',$request->input('fechaFinPedido'));
            })
            ->when($request->input('fechaInicioEntrega'), function($query) use ($request){
                if (is_null($request->input('fechaFinEntrega'))){                
                    $fecha=date("y-m-d");                        
                }
                else{
                    $fecha= $request->input('fechaFinEntrega');
                }
                $query->where('orden.dato0','>=',$request->get('fechaInicioEntrega'))
                ->where('orden.dato0','<=',$fecha);
            })
            ->when($request->input('fechaFinEntrega'), function($query) use ($request){ 
                if (is_null($request->input('fechaInicioEntrega'))){ 
                    $fecha= date("y-m-d",strtotime($request->input('fechaInicioEntrega')."- 1 year"));                       
                }
                else{
                    $fecha= $request->input('fechaInicioEntrega');
                }
                $query->where('orden.dato0','>=',$fecha)
                ->where('orden.dato0','<=',$request->input('fechaFinEntrega'));
            })
            // Filtro General
            ->when($request->input('estado'), function($query) use ($request){
                $query->where('dato59','=',$request->input('estado'));
            })
            ->when($request->input('usuario'), function($query) use ($request){                
                $query->with(["usuario" => function($query) use ($request) {
                    $query->where( 'nombre', $request->input('usuario'));
                }]);

                // dd($query);
                // $query->usuario->where('nombre',$request->input('usuario'));
                // $query->where( 'u.nombre', $request->input('usuario'));
            })
            ->when($request->input('sede'), function($query) use ($request){
                $query->where('u.sede',$request->input('sede'));
            })
            // Filtro por Formula OD
            ->when($request->input('esferaOD'), function($query) use ($request){
                $query->where('orden.dato2',$request->input('esferaOD'));
            })
            ->when($request->input('cilindroOD'), function($query) use ($request){
                $query->where('orden.dato3',$request->input('cilindroOD'));
            })
            ->when($request->input('adicionOD'), function($query) use ($request){
                $query->where('orden.dato5',$request->input('adicionOD'));
            })
            ->when($request->input('lenteOD'), function($query) use ($request){
                $query->where('orden.dato9',$request->input('lenteOD'));
            })
            ->when($request->input('biselOD'), function($query) use ($request){
                $query->where('orden.dato12',$request->input('biselOD'));
            })
            // Filtro por Formula OI
            ->when($request->input('esferaOI'), function($query) use ($request){
                $query->where('orden.dato14',$request->input('esferaOI'));
            })
            ->when($request->input('cilindroOI'), function($query) use ($request){
                $query->where('orden.dato15',$request->input('cilindroOI'));
            })
            ->when($request->input('adicionOI'), function($query) use ($request){
                $query->where('orden.dato17',$request->input('adicionOI'));
            })
            ->when($request->input('lenteOI'), function($query) use ($request){
                $query->where('orden.dato21',$request->input('lenteOI'));
            })
            ->when($request->input('biselOI'), function($query) use ($request){
                $query->where('orden.dato24',$request->input('biselOI'));
            })
            // Filtro por Lente
            ->when($request->input('tipol'), function($query) use ($request){
                $query->where('orden.dato26',$request->input('tipol'));
            })
            ->when($request->input('claseProgresivol'), function($query) use ($request){
                $query->where('orden.dato27',$request->input('claseProgresivol'));
            })
            ->when($request->input('tratamientol'), function($query) use ($request){
                $query->where('orden.dato29',$request->input('tratamientol'));
            })
            ->when($request->input('colorLtel'), function($query) use ($request){
                $query->where('orden.dato30',$request->input('colorLtel'));
            })
            ->when($request->input('materiall'), function($query) use ($request){
                $query->where('orden.dato31',$request->input('materiall'));
            })
            ->orderBy('fecha');
        }
        //Export Excel 
        if($request->input("excelCheck") == "1"){
            $ordenes = $ordenes->get();
            $fechaExcel = date("y-m-d");            
            return Excel::download(new FiltroExport($ordenes), '('.$fechaExcel.') Filtros.xlsx');
        }
        else{
            $ordenes = $ordenes->with(['usuario', 'cliente'])->paginate(100);
        }
        //Acondicionamiento de la variable de Conteo de Fltros.
        if (count($ordenes)==100){
            $cantidadFiltrados= $ordenes->total();
        }
        else{            
            $cantidadFiltrados = count($ordenes);
        }       
        
        return view('admin.informe.filtros',
        ["seleccionables"=>$seleccionables,         
        "usuarios"=>$usuarios,
        "sedes"=>$sedes,
        "ordenes"=>$ordenes,
        "request"=>$request,
        "total"=>$total,
        "cantidadFiltrados"=>$cantidadFiltrados,
        "data"=>$data,
        ]);                          
    } 
    
    //--------------------------------------------Garantia------------------------------------------------------

    function informeGarantia(Request $request)
    {  
        dd('En Construcción');         
        $data=$request->all();
        $usuarios=User::select('nombre','sede')->all();        
        $total['total']=0;
        $total['abono']=0;
        $total['saldo']=0;
        $total['montura']=0;
        $total['lente']=0;

        if($request->input('fechaInicio')=="" & $request->input('fechaFin')=="" &
            $request->input('estado')=="" & $request->input('usuario')==""){
            $fechaActual=date("y-m-d");
            $fechaInicio=date("y")."-01-01";
            $garantias = DB::table('garantia_detalle as garantia')
            ->select('u.*','garantia.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion',
            'c.dato11 as c_sede','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','garantia.dato58')
            ->leftjoin('clientes as c','c.id','=','garantia.cliente_id')
            ->whereBetween('garantia.fecha',[$fechaInicio, $fechaActual])
            ->orderBy('garantia.fecha');
        }
        else{  
            $garantias=DB::table('garantia_detalle as garantia')
            ->select('u.*','garantia.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion',
            'c.dato11 as c_sede','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','garantia.dato58')
            ->leftjoin('clientes as c','c.id','=','garantia.cliente_id')
            //Filtro por Fecha de Garantia
            ->when($request->input('fechaInicio'), function($query) use ($request){
                if (is_null($request->input('fechaFin'))){                
                    $fecha=date("y-m-d");                        
                }
                else{
                    $fecha= $request->input('fechaFin');
                }
                $query->where('garantia.fecha','>=',$request->get('fechaInicio'))
                ->where('garantia.fecha','<=',$fecha);
            })
            ->when($request->input('fechaFin'), function($query) use ($request){ 
                if (is_null($request->input('fechaInicio'))){ 
                    $fecha= date("y-m-d",strtotime($request->input('fechaInicio')."- 1 year"));                       
                }
                else{
                    $fecha= $request->input('fechaInicio');
                }
                $query->where('garantia.fecha','>=',$fecha)
                ->where('garantia.fecha','<=',$request->input('fechaFin'));
            })            
            // Filtro General
            ->when($request->input('estado'), function($query) use ($request){
                $query->where('dato59','=',$request->input('estado'));
            })
            ->when($request->input('usuario'), function($query) use ($request){
                $query->where('nombre',$request->input('usuario'));
            })       
            ->orderBy('garantia.fecha');
        }
        //Export Excel 
        if($request->input("excelCheck") == "1"){
            $garantias = $garantias->get();
            $fechaExcel = date("y-m-d");   

            return Excel::download(new GarantiaExport($garantias),'('.$fechaExcel.') Garantias.xlsx');
        }
        else{
            $garantias = $garantias->paginate(100);
        }
        //Acondicionamiento de la variable de Conteo de Fltros.
        if (count($garantias)==100){
            $cantidadFiltrados= $garantias->total();
        }
        else{            
            $cantidadFiltrados = count($garantias);
        }        

        return view('admin.informe.garantias',
        ["garantias"=>$garantias,       
        "usuarios"=>$usuarios,
        "request"=>$request,
        "cantidadFiltrados"=>$cantidadFiltrados,
        "total"=>$total,
        "data"=>$data,
        ]);
                          
    }

    //---------------------------------------------Cotizaciones-----------------------------------------------------

    function informeCotizacion(Request $request)
    {      
        dd('En Construcción');
        $data=$request->all();        
        $usuarios = User::select( 'nombre','sede' )->get()->all();        
        $total['total'] = 0;
        $total['abono'] = 0;
        $total['saldo'] = 0;
        $total['montura'] = 0;
        $total['lente'] = 0;

        if($request->input('fechaInicio')=="" & $request->input('fechaFin')=="" &
            $request->input('estado')=="" & $request->input('usuario')==""){ 
            $fechaActual=date("y-m-d");
            $fechaInicio=date("y")."-01-01";
            $cotizaciones=DB::table('cotizacion_detalle as cotizacion')
            ->select('u.*','cotizacion.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion',
            'c.dato11 as c_sede','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','cotizacion.dato58')
            ->leftjoin('clientes as c','c.id','=','cotizacion.cliente_id')
            ->whereBetween('cotizacion.fecha',[$fechaInicio, $fechaActual])
            ->orderBy('cotizacion.fecha');
        }
        else{  
            $cotizaciones=DB::table('cotizacion_detalle as cotizacion')
            ->select('u.*','cotizacion.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion',
            'c.dato11 as c_sede','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','cotizacion.dato58')
            ->leftjoin('clientes as c','c.id','=','cotizacion.cliente_id')
            //Filtro por Fecha de cotizacion
            ->when($request->input('fechaInicio'), function($query) use ($request){
                if (is_null($request->input('fechaFin'))){                
                    $fecha=date("y-m-d");                        
                }
                else{
                    $fecha= $request->input('fechaFin');
                }
                $query->where('cotizacion.fecha','>=',$request->get('fechaInicio'))
                ->where('cotizacion.fecha','<=',$fecha);
            })
            ->when($request->input('fechaFin'), function($query) use ($request){ 
                if (is_null($request->input('fechaInicio'))){ 
                    $fecha = date("y-m-d",strtotime($request->input('fechaInicio')."- 1 year"));                       
                }
                else{
                    $fecha= $request->input('fechaInicio');
                }
                $query->where('cotizacion.fecha','>=',$fecha)
                ->where('cotizacion.fecha','<=',$request->input('fechaFin'));
            })            
            // Filtro General
            ->when($request->input('estado'), function($query) use ($request){
                $query->where('dato59','=',$request->input('estado'));
            })
            ->when($request->input('usuario'), function($query) use ($request){
                $query->where('nombre',$request->input('usuario'));
            })       
            ->orderBy('cotizacion.fecha');
        }
         //Export Excel 
        if($request->input("excelCheck") == "1"){
            $cotizaciones = $cotizaciones->get();
            $fechaExcel = date("y-m-d");

            return Excel::download(new CotizacionExport($cotizaciones),'('.$fechaExcel.') Cotizaciones.xlsx');
        }
        else{
            $cotizaciones = $cotizaciones->paginate(100);
        }
        //Acondicionamiento de la variable de Conteo de Fltros.
        if (count($cotizaciones)==100){
            $cantidadFiltrados= $cotizaciones->total();
        }
        else{            
            $cantidadFiltrados = count($cotizaciones);
        }        

        return view('admin.informe.cotizaciones',
        ["cotizaciones"=>$cotizaciones,       
        "usuarios"=>$usuarios,
        "request"=>$request,
        "cantidadFiltrados"=>$cantidadFiltrados,
        "total"=>$total,
        "data"=>$data,
        ]);                          
    }

    //-----------------------------------------------Filtro Ordenes por Mes---------------------------------------------------

    function informeOrdenMes(Request $request)
    {   
        $data = $request->all();
        $agnoActual = date( "Y" );
        $agnoInicio = date( "Y" ) - 2;
        $usuarios = User::all();        
        $total['total'] = 0;
        $total['abono'] = 0;
        $total['saldo'] = 0;
        $total['montura'] = 0;
        $total['lente'] = 0;

        if ($request->input('mes') == "" & $request->input('agno')=="" ){         
            $mesActual=date("m");
            $ordenes=DB::table('orden_detalle as orden')
            ->select('u.*','orden.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion',
            'c.dato11 as c_sede','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','orden.dato58')
            ->leftjoin('clientes as c','c.id','=','orden.cliente_id')
            ->whereYear('orden.fecha','=',$agnoActual)
            ->whereMonth('orden.fecha', '=',$mesActual)
            ->orderBy('orden.fecha');
            $request->agno = $agnoActual;
            $request->mes =$mesActual;
        }
        elseif( $request->input('mes') == "" & !$request->input('agno') =="" ){         
            $ordenes=DB::table('orden_detalle as orden')
            ->select('u.*','orden.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion',
            'c.dato11 as c_sede','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','orden.dato58')
            ->leftjoin('clientes as c','c.id','=','orden.cliente_id')
            ->whereYear('orden.fecha','=',$request->input('agno'))
            // ->whereMonth('orden.fecha', '=',$mesActual)
            ->orderBy('orden.fecha');
        }
        else{  
            $ordenes=DB::table('orden_detalle as orden')
            ->select('u.*','orden.*', 'c.dato1 as c_nombre','c.dato2 as c_documento','c.dato3 as c_celular',
            'c.dato4 as c_telefono', 'c.dato5 as c_fechaNacimiento','c.dato6 as c_correo','c.dato7 as c_direccion',
            'c.dato8 as c_municipio', 'c.dato9 as c_observaciones', 'c.dato10 as c_fechaCreacion',
            'c.dato11 as c_sede','c.tipodoc as c_tipoDoc')
            ->leftjoin('usuarios as u','u.nombre','=','orden.dato58')
            ->leftjoin('clientes as c','c.id','=','orden.cliente_id')
            //Filtro por Mes
            ->whereYear('orden.fecha','=',$request->input('agno'))
            ->whereMonth('orden.fecha', '=',$request->input('mes'))
            ->orderBy('orden.fecha');   
        }
         //Export Excel 
         if($request->input("excelCheck") == "1"){
            $ordenes = $ordenes->get();
            $fechaExcel = date("y-m-d");   

            return Excel::download(new TotalMesExport($ordenes),'('.$fechaExcel.') TotalMes.xlsx');
        }
        else{
            $ordenes = $ordenes->paginate(100);
        }
        //Acondicionamiento de la variable de Conteo de Fltros.
        if (count($ordenes)==100){
            $cantidadFiltrados= $ordenes->total();
        }
        else{            
            $cantidadFiltrados = count($ordenes);
        }        

        return view('admin.informe.totalMes',
        ["ordenes"=>$ordenes,       
        "usuarios"=>$usuarios,
        "request"=>$request,
        "cantidadFiltrados"=>$cantidadFiltrados,
        "total"=>$total,
        "agnoActual"=>$agnoActual,
        "agnoInicio"=>$agnoInicio,
        "data"=>$data,
        ]);                         
    }   
    //Codificar con Has todas las contraseñas.
    private function __codificarPassword(){        
        $usuarios = User::select('*')->get();
        foreach ($usuarios as $usuario) {
            $user = User::find($usuario->id);
            $user->contrasena = Hash::make($usuario->contrasena);
            $user->update();
        }
    }
}
    