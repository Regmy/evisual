<?php

namespace eVisual\Http\Controllers\Auth;

use eVisual\User;
use eVisual\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'documento ' => ['required', 'numeric', 'min:5', 'confirmed'],
            'rol' => ['required', 'string', 'min:1', 'confirmed'],
            'sede' => ['required', 'string', 'min:1', 'confirmed'],
            'contrasena' => ['required', 'string', 'min:1', 'confirmed'],
            'nivelacceso' => ['required', 'string', 'min:1', 'confirmed'],
            'agree_terms_and_conditions' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['name'],
            'documento' => $data['documento'],
            'rol' => $data['rol'],
            'sede' => $data['sede'],
            'nivelacceso' => $data['nivelacceso'],
            'email' => $data['email'],
            'contrasena' => Hash::make($data['password']),
        ]);
    }
}
