<?php

namespace eVisual\Http\Controllers;

use Illuminate\Http\Request;
use eVisual\UsersRegistroModel;
use Illuminate\Support\Facades\Redirect; //para poder redireccionar
use eVisual\Http\Requests\UserLoginRequest;
use DB;

class UsersRegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Se llama con metodos GET  php artisan route:list 
        //echo 'hola Index de usuario </br>';
        if($request){
            $query=trim($request->get('searchText'));
            $nombreUsuario=DB::table('usuarios')->where('documento','LIKE','%'.$query.'%');
            
        }
        //echo 'Este es el nombre del Usuario: ' . $nombreUsuario->first()->nombre;
        //echo '</br>';
        $usuariosall=UsersRegistroModel::get();
        echo json_encode($usuariosall);

        //print_r($nombreUsuario);

        //print_r($request-> all());
        // return view('carpeta.carpeta.nombreDeArchivo.index,["NombredelParametro=>$variable a enviar,"Nombredeotroparametro"=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Se llama con metodos GET Segun no se usa en api, se puede borrar
        //return view("carpeta.carpeta.nombredelarchivo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserLoginRequest $request)
    { 
        // Se llama con metodos POST
        if ($request){
            echo 'hola store';
            //print_r($request-> all()); // imprime todo ingresado al request, sin formato
            $registroUsuario = new UsersRegistroModel();
            $registroUsuario->nombre=utf8_encode(trim($request->input('nombreIn')));
            $registroUsuario->documento=utf8_encode(trim($request->input('documentoIn')));
            $registroUsuario->contrasena=utf8_encode(trim($request->input('contrasenaIn')));
            $registroUsuario->rol=utf8_encode(trim($request->input('rolIn')));
            $registroUsuario->sede=utf8_encode(trim($request->input('sedeIn')));
           // trim($request->input('sedeIn'))
            $registroUsuario->save();
            echo json_encode($registroUsuario);
            //return Redirect::to('carpeta.carpeta.archivo');
        }
        else {
            // Mostrar una ventana emergente indicando que verifique los datos ingresados.
            echo 'no llego el request';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \nuevo-nombre\mRegistro  $mRegistro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Se llama con metodos GET Segun no se usa en api, se puede borrar
        //return view('carpeta.carpeta.archivo',["nombredelPArametro=>NmbredelModelo::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \nuevo-nombre\mRegistro  $mRegistro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  Se llama con metodos GET Segun no se usa en api, se puede borrar
        //return view('carpeta.carpeta.archivo',["nombredelPArametro=>NmbredelModelo::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \nuevo-nombre\mRegistro  $request_id
     * @return \Illuminate\Http\Response
     */
    public function update(UserLoginRequest $request, $id)
    {
        //  Se llama con metodos PATCH Se llama con metodos PUT php artisan route:list
        echo 'hellow from update';

        $registroUsuario=UsersRegistroModel::findOrFail($id);
        $registroUsuario->nombre=$request->get('nombreIn');
        $registroUsuario->documento=$request->get('documentoIn');
        $registroUsuario->contrasena=$request->get('contrasenaIn');
        $registroUsuario->rol=$request->get('rolIn');
        $registroUsuario->sede=$request->get('sedeIn');
        $registroUsuario->update();
        echo json_encode($registroUsuario);
        //return Redirect::to('carpeta.carpeta.archivo');
        


        /*$mRegistro = mRegistro::find($mRegistro_id);
        $mRegistro->$nombre = $request->input('nombre');
        $mRegistro->$contrasena = $request ->input('contrasena');
        $mRegistro->save();
        echo json_encode($mRegistro);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \nuevo-nombre\mRegistro  $mRegistro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registroUsuario=UsersRegistroModel::findOrFail($id); 
        $registroUsuario->delete();
        echo 'destruido el ID: '. $id .' : ' ;
        echo json_encode($registroUsuario);


        // Se llama con metodos DELETE php artisan route:list 
       /*echo 'hellow from destroy'; 
        $mRegistro = mRegistro::find($mRegistro_id);
        $mRegistro->destroy();*/
    }
}