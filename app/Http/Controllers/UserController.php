<?php

namespace eVisual\Http\Controllers;

use eVisual\User;
use eVisual\MFacturaRango;
use eVisual\MClientes;
use eVisual\MOrdenDetalles;
use eVisual\MCotizaciones;
use eVisual\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    function randomsedeclientes(){
        $arraySede_id[]     = [];
        $sedes_id           = MFacturaRango::select('id')->get();
        foreach ( $sedes_id as $sede_id ){
            $arraySede_id[] =  $sede_id->id;
        }
        $arraySede_id[0]    = 1;
        $clientes           = MClientes::where('id','>=', '0' )->get();    
        foreach ( $clientes as $cliente ){
            $cliente -> factura_rango_id = $arraySede_id[ array_rand ($arraySede_id) ];
            $cliente -> save();
        }

        return redirect()->route('modify')->withStatus(__('Script 5 Ejecutado'));
    }
    // Rutina para cambiar los nombres de las sedes por su indice en Clientes.
    public function indiceSedeTablaClientes(){
        $clientesSede =  MClientes::all();        
        $arrayclientes =[];
        foreach ($clientesSede as $cambiar) {
            $idsede = MFacturaRango::select( 'id')->where('sede', $cambiar->dato11)->first();
            if ( $idsede  ){
                if ( is_numeric($idsede) ){
                    continue;
                }
                $cambiar->dato11 = (integer) $idsede->id;                
                $cambiar->save();            
            }            
            elseif( $cambiar->dato11 == "EVB EVOLUCIÃ“N VISUAL BELLO" ){
                $cambiar->dato11 = 5;
                $cambiar->save();
            }else{
                $cambiar->dato11 = 1;
                $cambiar->save();
            }            
        }
        return redirect()->route('modify')->withStatus(__('Script 3 Ejecutado'));
    }

    // Rutina para cambiar los nombres de las sedes por su indice en Usuarios.
    public function indiceSedeTablaUsuarios(){
        $usuarioSede =  User::select('*')->get();
        foreach ($usuarioSede as $cambiar) {
            $idsede = MFacturaRango::select( 'id_fct')->where('sede', $cambiar->sede )->first();
            if ($idsede){
                $cambiar->sede = $idsede->id_fct;
                $cambiar->save();            
            }
        }
        return redirect()->route('modify')->withStatus(__('Script 2 Ejecutado'));
    }

    public function indiceUsuarioTablaOrdenDetalle(){
        ini_set('max_execution_time',0);
        $ordenes = MOrdenDetalles::select('dato58','usuario_id')->get();
        foreach ($ordenes as $orden){
            $idUsuario =  User::select('id')->where('nombre', $orden->dato58)->first();
            if ( $orden->usuario_id === 0){
                if($idUsuario){
                    $orden->usuario_id = $idUsuario->id;  
                    $orden->save();        
                }
                else{
                    $orden->usuario_id = 1;
                    $orden->save();
                }        
            }
        }
        return redirect()->route('modify')->withStatus(__('Script 1 Ejecutado'));
    }

    public function indiceUsuarioTablaCotizacionDetalles(){
        ini_set('max_execution_time',0);
        $cotizaciones = MCotizaciones::all();
        foreach ($cotizaciones as $cotizacion){
            $idUsuario =  User::select('id')->where('nombre', $cotizacion->dato58)->first();
            if ( $cotizacion->usuario_id === 0){
                if($idUsuario){
                    $cotizacion->usuario_id = $idUsuario->id;  
                    $cotizacion->save();
                }
                else{
                    $cotizacion->usuario_id = 1;
                    $cotizacion->save();
                }        
            }            
        }
        return redirect()->route('modify')->withStatus(__('Script 4 Ejecutado'));
    }

    public function index(Request $request, User $model)
    {        
        if ($request->get('searchText') =='')
        {
            return view('users.index', ['users' => $model->paginate(15)]);
        }
        else
        {
            $buscar=trim($request->get('searchText')); //Buscar Cliente por documento
            $buscar=(int)$buscar;// se convierte en Int ya que la base de dato el parametro documento es int.
            $model=User::where('documento','LIKE','%'.$buscar.'%')
            ->orderBy('nombre','desc')->paginate(15);
            return view('users.index',["users"=>$model, "searchText"=>$buscar]);
        }        
    }

    public function create()
    {
        $sedes = MfacturaRango::select('sede','id')->get()->toArray();
        return view('users.create',[
            "sedes" => $sedes,
        ]);
    }

    public function store(UserRequest $request)
    {
        $usuario = User::where('documento',$request->get('documento'))->first();
        if(!is_null($usuario)){                        
            return redirect()->route('user.create')->with('badStatus' , 'El usuario "'. $usuario->nombre . '"' .
            " con el Documento: " . $usuario->documento . " ya se encuentra Registrado.");
        }
        else{
            $model = new User;
            $model->nombre=trim($request->input('nombre'));
            $model->documento=trim($request->input('documento'));
            $model->rol=trim($request->input('rol'));
            $model->sede_id=trim($request->input('sede'));
            $model->email=trim($request->input('email'));
            $hashpassword = $request->input('password');
            $model->contrasena=Hash::make($hashpassword);
            $model->nivelacceso=trim($request->input('nivelacceso'));
            $model->save();
        }       
        /*$model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        */
        return redirect()->route('user.index')->withStatus(__('Usuario Creado Sastifactoriamente.'));
    }

    public function edit(User $user)
    {
        $sedes = MfacturaRango::select('sede','id')->get()->toArray();
        return view('users.edit', [
            "user" => $user,
            "sedes" => $sedes,
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $hasPassword = $request->get('password') ? 1 : 0;        
        $user->nombre=trim($request->input('nombre'));
        $user->documento=trim($request->input('documento'));
        $user->rol=trim($request->input('rol'));
        $user->sede_id=trim($request->input('sede'));
        $user->email=trim($request->input('email'));        
        $user->contrasena=Hash::make($request->get('password'));
        $user->nivelacceso=trim($request->input('nivelacceso'));
        $user->update();
        
        /*$user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$hasPassword ? '' : 'password']
        ));*/

        return redirect()->route('user.index')->withStatus(__('Usuario Actualizado Sastifactoriamente.'));
    }

    public function destroy(User  $user)
    {
        // $user->delete();
        return redirect()->route('user.index')->withStatus(__('El Usuario no se puede Eliminar.'));
        // return redirect()->route('user.index')->withStatus(__('Usuario Eliminado Correctamente.'));
    }
}
