<?php

namespace eVisual\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use eVisual\Http\Requests\RClientes;
use eVisual\MClientes;
use DB;

class CClientes extends Controller
{    
     function index(Request $request, MClientes $clientes)
    {
        $data = $request->all();
        if( !is_null($request->get('searchText'))){            
            if ($request->get('accion') == 'documento') {                
                if ($request->get('checkbox') == 'on') {                    
                    $buscar=trim($request->get('searchText')); //Buscar Cliente por documento en todas las sedes
                    $clientes = MClientes::where('dato2','LIKE','%'.$buscar.'%')
                    ->orderBy('dato10','desc')->paginate(15);
    
                    return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar,"data"=>$data]);   
                }
                else
                {
                    $buscar=trim($request->get('searchText')); //Buscar Cliente por documento en la misma sede
                    $clientes = MClientes::where('dato2','LIKE','%'.$buscar.'%')
                    ->where('factura_rango_id',auth()->user()->sede->id)
                    ->orderBy('dato10','desc')->paginate(15);
                    
                    return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar,"data"=>$data]);   
                }
            }
            if ($request->get('accion') == 'nombre') {                
                if ($request->get('checkbox') == 'on') {                    
                    $buscar=trim($request->get('searchText')); //Buscar Cliente por nombre en todas las sedes
                    $clientes = MClientes::where('dato1','LIKE','%'.$buscar.'%')
                    ->orderBy('dato10','desc')->paginate(15);
    
                    return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar,"data"=>$data]);   
                }
                else
                {
                    $buscar=trim($request->get('searchText')); //Buscar Cliente por nombre en la misma sede
                    $clientes = MClientes::where('dato1','LIKE','%'.$buscar.'%')
                    ->where('factura_rango_id',auth()->user()->sede->id)
                    ->orderBy('dato10','desc')->paginate(15);
                    
                    return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar,"data"=>$data]);   
                }
            }
            if ($request->get('accion') == 'telefono') {                
                if ($request->get('checkbox') == 'on') {                    
                    $buscar=trim($request->get('searchText')); //Buscar Cliente por telefono en todas las sedes
                    $clientes = MClientes::where('dato3','LIKE','%'.$buscar.'%')
                    ->orderBy('dato10','desc')->paginate(15);
    
                    return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar,"data"=>$data]);   
                }
                else
                {
                    $buscar=trim($request->get('searchText')); //Buscar Cliente por telefono en la misma sede
                    $clientes = MClientes::where('dato3','LIKE','%'.$buscar.'%')
                    ->where('factura_rango_id',auth()->user()->sede->id)
                    ->orderBy('dato10','desc')->paginate(15);
                    
                    return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar,"data"=>$data]);   
                }   
            }
       }
       else{
           $buscar=trim($request->get('searchText')); //Buscar Cliente por defecto (documento en la misma sede)
            $clientes = MClientes::where('factura_rango_id', auth()->user()->sede->id)
            ->orderBy('dato10','desc')->paginate(15);

        return view('clientes.index',["clientes"=>$clientes, "searchText"=>$buscar,"data"=>$data]);
       }
    }

     function create(Request $request)
    {             
        $cliente = (object) [            
            "identification"=> "",
            "identification_type"=> "CC",
            "first_name"=> "",
            "first_name2"=> "",
            "last_name"=> "",
            "last_name2"=> "",
            "dob"=> "",
            "phone"=> "",
            "mobile"=> "",
            "address"=> "",
            "email"=> "",
            "notes"=> ""
        ];

        if($request->has('_token')){
            if( $request->get('documento2') != "" && $request->get('tipoDocumento2') != "" ){
                    $cliente = DB::connection('mysqlopti')->table('patients')->where('identification',$request->get('documento2'))
                    ->where('identification_type',$request->get('tipoDocumento2'))->first();                                         
                    if(!is_null($cliente)){

                        return view('clientes.create',["cliente"=>$cliente]); 
                    }
                    else{

                        return redirect()->route('clientes.create')->with('badStatus' , 'El Documento: ' . $request->get('tipoDocumento2') . ' - ' . $request->get('documento2')  . ' No se encuentra en Optisoft');
                    }
            }
            if( $request->get('documento3') != "" && $request->get('tipoDocumento3') != "" ){
                    $cliente = MClientes::where('dato2',$request->get('documento3'))
                    ->where('tipodoc',$request->get('tipoDocumento3'))->first();                                         
                    if(!is_null($cliente)){

                        return redirect()->route('clientes.create')->with('status' , 'El Cliente: ' . $cliente->dato1 . ' - ' . 'se encuentra registrado en VE');
                    }
                    else{
                        $cliente = MClientes::where('dato2',$request->get('documento3'))->first();                        
                        if(!is_null($cliente)){

                            return redirect()->route('clientes.create')->with('status' , 'El Documento: ' . $request->get('documento3')  . ' se encuentra Registrado en VE a nombre de:' . $cliente->dato1 . ' (Se recomienda verificar el Nombre del cliente y Actualizar el tipo de documento)');
                        }

                        return redirect()->route('clientes.create')->with('badStatus' , 'El Documento: ' . $request->get('tipoDocumento3') . ' - ' . $request->get('documento3')  . ' No se encuentra en VE');
                    }
            }
            else{

                return redirect()->route('clientes.create')->with('badStatus' , 'Debe Ingresar el documento y el tipo de documento.');
            }
        }

        return view('clientes.create',["cliente"=>$cliente]);
    }

     function store(RClientes $request)
    { 
        $cliente = MClientes::where('dato2',$request->get('documento'))->first();
        if(!is_null($cliente)){
                        
            return redirect()->route('clientes.create')->with('badStatus' , 'El Cliente "'. $cliente->dato1 . '"' .
            " con el Documento: " . $cliente->dato2 . " ya se encuentra Registrado.");
        }
        else{
            $registroCliente = new MClientes();
            $registroCliente->dato1=trim($request->input('nombre')); //NOMBRES Y APELLIDOS
            $registroCliente->dato2=trim($request->input('documento')); //DOCUMENTO
            $registroCliente->dato3=trim($request->input('celular')); //CELULAR
            $registroCliente->dato4=trim($request->input('telefono')); //TELEFONO
            $registroCliente->dato5=trim($request->input('cumpleanos')); //CUMPLEAÑOS
            $registroCliente->dato6=trim($request->input('correo')); //CORREO
            $registroCliente->dato7=trim($request->input('direccion')); //DIRECCION
            $registroCliente->dato8=trim($request->input('municipio')); //MUNICIPIO
            $registroCliente->dato9=trim($request->input('observaciones')); //OBSERVACIONES
            $registroCliente->dato10=trim($request->input('fechaCreacion')); //FECHA DE CREACION
            $registroCliente->factura_rango_id=auth()->user()->sede->id;//SEDE
            $registroCliente->tipodoc=trim($request->input('tipoDocumento')); //TIPO DE DOCUMENTO
            $registroCliente->save();
        }

        return redirect()->route('clientes.index')->withStatus(__('Cliente Creado Sastifactoriamente.'));        
    }

     function show( $id )
    {
        return view( 'clientes.show', [ "cliente" => MClientes::findOrFail( $id ) ] );
    }

     function edit( MClientes $cliente )
    {
        return view( 'clientes.edit', [ "cliente" => $cliente ] );
    }

     function update(RClientes $request, MClientes $cliente)
    {
        $cliente->dato1=$request->get('nombre');
        $cliente->dato2=$request->get('documento');
        $cliente->dato3=$request->get('celular');
        $cliente->dato4=$request->get('telefono'); 
        $cliente->dato5=$request->get('cumpleanos');
        $cliente->dato6=$request->get('correo');
        $cliente->dato7=$request->get('direccion');
        $cliente->dato8=$request->get('municipio');
        $cliente->dato9=$request->get('observaciones');
        // $cliente->factura_rango_id= $request->get('sede');
        $cliente->tipodoc=$request->get('tipoDocumento');
        $cliente->update();

        return redirect()->route('clientes.index')->withStatus( __( 'Cliente Actualizado Sastifactoriamente.' ) );
    }

     function destroy( MClientes $cliente )
    {
        $cliente->delete();

        return redirect()->route( 'clientes.index' )->withStatus( __( 'Cliente Eliminado Correctamente.' ) );
    }
}