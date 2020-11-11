@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ asset('paper/img/headerprofile.jpg') }}" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray" src="{{ asset('paper/img/default-avatar.png') }}" alt="...">

                                <h5 class="title">{{ __(auth()->user()->nombre)}}</h5>
                            </a>                            
                        </div>
                        <p class="description text-center">
                            {{ __('Documento: ') }} {{ __(auth()->user()->documento)}}
                            <br> {{ __('Rol') }} {{ __(auth()->user()->rol)}}
                            <br> {{ __('Sede') }} {{ __(auth()->user()->sede->sede)}}
                            <br> {{ __('Nivel de Acceso') }} {{ __(auth()->user()->nivelacceso)}}
                            <br> {{ __('Correo') }} {{ __(auth()->user()->email)}}  
                        </p>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="button-container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-6 ml-auto">
                                    <div class="text-left" >{{ __(auth()->user()->created_at->format('d/m/y'))}}
                                        <br>
                                        <small>{{ __('Creado') }}</small>
                                    </div>
                                </div>                                
                                <div class="col-lg-6 mr-auto">
                                    <div class="text-right">{{ __(auth()->user()->updated_at->format('d/m/y'))}}
                                        <br>
                                        <small>{{ __('Actualizado') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-center">
                <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card">                    
                        <div class="card-header">
                            <h5 class="title">{{ __('Editar Perfil') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Nombre') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ auth()->user()->nombre }}" required>
                                    </div>
                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Documento') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="documento" class="form-control" placeholder="Documento" value="{{ auth()->user()->documento }}" required>
                                    </div>
                                    @if ($errors->has('documento'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('documento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Rol') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="rol" class="form-control" placeholder="Rol" value="{{ auth()->user()->rol }}" required>
                                    </div>
                                    @if ($errors->has('rol'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('rol') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Sede') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="sede" class="form-control" placeholder="Sede" value="{{ auth()->user()->sede->sede }}" required>
                                    </div>
                                    @if ($errors->has('sede'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('sede') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Email') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Guardar Cambios') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12" action="{{ route('profile.password') }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Cambiar Contraseña') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Nivel de Acceso') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <select class="form-control" id="nivelacceso" type="text" name="nivelacceso" placeholder="Nivel de Acceso" value="{{ auth()->user()->nivelacceso }}" required >
                                              <option>Administrador</option>
                                              <option>Usuario</option>
                                        </select>                                   
                                        <!--input type="text" name="nivelacceso" class="form-control" placeholder="Nivel de Acceso" value="{{ auth()->user()->name }}" required-->
                                        @if ($errors->has('nivelacceso'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('nivelacceso') }}</strong>
                                            </span>
                                         @endif
                                    </div>                                    
                                </div> 
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Contraseña Actual') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="old_password" class="form-control" placeholder="Contraseña Actual" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Nueva Contraseña') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Nueva Contraseña" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Confirmar Contraseña') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Guardar Cambios') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection