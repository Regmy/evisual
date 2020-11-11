@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'edit'
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
                                    <h3 class="mb-0">{{ __('Edición de Cliente') }}</h3>
                                </div>  
                                <div class="col-4 text-right">
                                    <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('clientes.update', $cliente) }}" autocomplete="off">                                
                                <input type="hidden" name="_method" value="PUT">                                
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                                
                                <h6 class="heading-small mb-4 text-dark ">{{ __('Información del Cliente') }}</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-nombre">{{ __('Nombre') }}</label>
                                        <input type="text" name="nombre" id="input-nombre" class="form-control form-control-alternative{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" value="{{ $cliente->dato1}}" required autofocus>

                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-tipoDocumento">{{ __('Tipo de Documento') }}</label>
                                        <select class="form-control" id="input-tipoDocumento" type="text" name="tipoDocumento" placeholder="Tipo de Documento" value="{{ $cliente->tipodoc}}" required >
                                              <option>CC</option>
                                              <option>TI</option>
                                              <option>CE</option>
                                              <option>PASAPORTE</option>
                                        </select>                                   
                                        <!--input type="text" name="nivelacceso" class="form-control" placeholder="Nivel de Acceso" value="{{ auth()->user()->name }}" required-->
                                        @if ($errors->has('tipoDocumento'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('tipoDocumento') }}</strong>
                                            </span>
                                         @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('documento') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-documento">{{ __('Documento') }}</label>
                                        <input type="text" name="documento" id="input-documento" class="form-control form-control-alternative{{ $errors->has('documento') ? ' is-invalid' : '' }}" placeholder="{{ __('Documento') }}" value="{{ $cliente->dato2}}" autofocus>

                                        @if ($errors->has('documento'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('documento') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('celular') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-celular">{{ __('Celular') }}</label>
                                        <input type="text" name="celular" id="input-celular" class="form-control form-control-alternative{{ $errors->has('celular') ? ' is-invalid' : '' }}" placeholder="{{ __('Celular') }}" value="{{ $cliente->dato3}}" required autofocus>

                                        @if ($errors->has('celular'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('celular') }}</strong>
                                            </span>
                                        @endif
                                    </div>  
                                    <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-telefono">{{ __('Teléfono') }}</label>
                                        <input type="text" name="telefono" id="input-telefono" class="form-control form-control-alternative{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Teléfono') }}" value="{{ $cliente->dato4}}">

                                        @if ($errors->has('telefono'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </div>                                  
                                    <div class="form-group{{ $errors->has('cumpleanos') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-cumpleanos">{{ __('Cumpleaños') }}</label>
                                        <input type="text" name="cumpleanos" id="input-cumpleanos" class="form-control form-control-alternative{{ $errors->has('cumpleanos') ? ' is-invalid' : '' }}" placeholder="{{ __('Cumpleaños') }}" value="{{ $cliente->dato5}}" required>

                                        @if ($errors->has('cumpleanos'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cumpleanos') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('correo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-correo">{{ __('Correo') }}</label>
                                        <input type="text" name="correo" id="input-correo" class="form-control form-control-alternative{{ $errors->has('correo') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo') }}" value="{{ $cliente->dato6}}">
                                        
                                        @if ($errors->has('correo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('correo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-direccion">{{ __('Dirección') }}</label>
                                        <input type="text" name="direccion" id="input-direccion" class="form-control form-control-alternative{{ $errors->has('direccion') ? ' is-invalid' : '' }}" placeholder="{{ __('Dirección') }}" value="{{ $cliente->dato7}}">
                                        
                                        @if ($errors->has('direccion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('municipio') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-municipio">{{ __('Municipio') }}</label>
                                        <input type="text" name="municipio" id="input-municipio" class="form-control form-control-alternative{{ $errors->has('municipio') ? ' is-invalid' : '' }}" placeholder="{{ __('Municipio') }}" value="{{ $cliente->dato8}}" required>
                                        
                                        @if ($errors->has('municipio'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('municipio') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('sede') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-sede">{{ __('Sede') }}</label>
                                        <input type="text" name="sede" id="input-sede" class="form-control form-control-alternative{{ $errors->has('sede') ? ' is-invalid' : '' }}" placeholder="{{ __('Sede') }}" value="{{ $cliente->sede->sede}}" required readonly>
                                        
                                        @if ($errors->has('sede'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('sede') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('fechaCreacion') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-fechaCreacion">{{ __('Fecha de Creación') }}</label>
                                        <input type="text" name="fechaCreacion" id="input-fechaCreacion" class="form-control form-control-alternative{{ $errors->has('fechaCreacion') ? ' is-invalid' : '' }}" placeholder="{{ __('fechaCreacion') }}" value="{{ $cliente->dato10}}" readonly='readonly'>

                                        @if ($errors->has('fechaCreacion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fechaCreacion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('observaciones') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-observaciones">{{ __('Observaciones') }}</label>
                                        <input type="text" style="height:10em" name="observaciones" id="input-observaciones" class="form-control form-control-alternative{{ $errors->has('observaciones') ? ' is-invalid' : '' }}" placeholder="{{ __('Observaciones') }}" value="{{ $cliente->dato9}}">
                                        
                                        @if ($errors->has('observaciones'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('observaciones') }}</strong>
                                            </span>
                                        @endif
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