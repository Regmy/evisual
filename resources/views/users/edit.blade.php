@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'user',
])

@section('content')
    <div class="content">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Editar Usuario') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.update', $user) }}" autocomplete="off">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                    
                                <h6 class="heading-small mb-4">{{ __('Información del Usuario') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-nombre">{{ __('Nombre') }}</label>
                                        <input type="text" name="nombre" id="input-nombre" class="form-control form-control-alternative{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" value="{{$user->nombre}}" required autofocus>

                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('documento') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-documento">{{ __('Documento') }}</label>
                                        <input type="text" name="documento" id="input-documento" class="form-control form-control-alternative{{ $errors->has('documento') ? ' is-invalid' : '' }}" placeholder="{{ __('Documento') }}" value="{{ $user->documento}}" required autofocus>

                                        @if ($errors->has('documento'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('documento') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('rol') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-rol">{{ __('Rol') }}</label>
                                        <select class="form-control form-control-alternative{{ $errors->has('rol') ? ' is-invalid' : '' }}" id="input-rol" type="text" name="rol" placeholder="{{ __('Rol') }}" value="{{ old('rol') }}" required autofocus >
                                            <option value="{{ $user->rol}}">{{ $user->rol}}</option>
                                            <option value="{{ $user->rol}}" >{{__('--')}}</option>
                                            <option value="asesor">{{__('Asesor')}}</option>                                                
                                            <option value="semiadministrador">{{__('Semi Administrador')}}</option>                                                                                              
                                            <option value="adminisis">{{__('Administrador')}}</option>>                                                                                              
                                        </select>
                                        @if ($errors->has('rol'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rol') }}</strong>
                                            </span>
                                        @endif
                                    </div>  
                                    <div class="form-group{{ $errors->has('sede') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-sede">{{ __('Sede') }}</label>
                                        <select class="form-control form-control-alternative{{ $errors->has('sede') ? ' is-invalid' : '' }}" id="input-sede" type="text" name="sede" placeholder="{{ __('Sede') }}" value="{{ old('sede') }}" required autofocus >
                                            @foreach ($sedes as $sede )
                                                <option value="{{$sede['id']}}">{{$sede['sede']}}</option>
                                            @endforeach                                                                                              
                                        </select>
                                        @if ($errors->has('sede'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('sede') }}</strong>
                                            </span>
                                        @endif
                                    </div>                                  
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">{{ __('Correo') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo') }}" value="{{ $user->email}}" required autocomplete="off">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-password">{{ __('Contraseña') }}</label>
                                        <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Contraseña') }}" value="" required autocomplete="off">
                                        
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmar Contraseña') }}</label>
                                        <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirmar Contraseña') }}" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="nivelacceso" value="">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Guardar') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection