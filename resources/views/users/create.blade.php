@php
    ini_set('max_execution_time',720);
@endphp
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'user',
])

@section('content')
    <div class="content">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Administración de Usuarios') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.store') }}" autocomplete="off">                                
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <h6 class="heading-small mb-4">{{ __('Información de Usuarios') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-nombre">{{ __('Nombre') }}</label>
                                        <input type="text" name="nombre" id="input-nombre" class="form-control form-control-alternative{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('nombre') }}" autofocus>
                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('documento') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-documento">{{ __('Documento') }}</label>
                                        <input type="text" name="documento" id="input-documento" class="form-control form-control-alternative{{ $errors->has('documento') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('documento') }}" autofocus>
                                        @if ($errors->has('documento'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('documento') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('rol') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-rol">{{ __('Rol') }}</label>
                                        {{-- <input type="text" name="rol" id="input-rol" class="form-control form-control-alternative{{ $errors->has('rol') ? ' is-invalid' : '' }}" placeholder="{{ __('Rol') }}" value="{{ old('rol') }}" required autofocus> --}}
                                        <select class="form-control form-control-alternative{{ $errors->has('rol') ? ' is-invalid' : '' }}" id="input-rol" type="text" name="rol" placeholder="" value="{{ old('rol') }}" autofocus >
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
                                    {{-- anexar selector --}}
                                    <div class="form-group{{ $errors->has('sede') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-sede">{{ __('Sede') }}</label>
                                        {{-- <input type="text" name="sede" id="input-sede" class="form-control form-control-alternative{{ $errors->has('sede') ? ' is-invalid' : '' }}" placeholder="{{ __('Sede') }}" value="{{ old('sede') }}" required autofocus> --}}
                                        <select class="form-control form-control-alternative{{ $errors->has('sede') ? ' is-invalid' : '' }}" id="input-sede" type="text" name="sede" placeholder="" value="{{ old('sede') }}" autofocus >
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
                                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-password">{{ __('Contraseña') }}</label>
                                        <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="" value="">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmar Contraseña') }}</label>
                                        <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="" value="">
                                    </div>
                                    {{-- <div class="form-group">
                                        <input type="hidden" name="nivelacceso" value="">                                        
                                    </div> --}}
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