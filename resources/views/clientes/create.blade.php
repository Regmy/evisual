@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'create',
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
                                    <h3 class="mb-0">{{ __('Administración de Clientes') }}</h3>
                                </div>  
                                <div class="col-12">
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    @if (session('badStatus'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('badStatus') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small mb-4">{{ __('Información de Clientes') }}</h6>
                            <div>
                                <div style="display: inline-block; margin-left: 3%">
                                    <form method="GET" action="{{ route('clientes.create') }}" autocomplete="off">                                
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input id='documentoSearch2' type="hidden" name="documento3">
                                        <input id='tipoDocumentoSearch2' type="hidden" name="tipoDocumento3">
                                        <button onclick="getdata2()" style="margin-top: 0px !important" type="submit" class="btn btn-success mt-4">{{ __('Buscar') }}</button>
                                    </form>   
                                </div>
                                <div  style="display: inline-block; margin-left: 2%">
                                    <form method="GET" action="{{ route('clientes.create') }}" autocomplete="off">                                
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input id='documentoSearch' type="hidden" name="documento2">
                                        <input id='tipoDocumentoSearch' type="hidden" name="tipoDocumento2">
                                        <button onclick="getdata()" style="margin-top: 0px !important" type="submit" class="btn btn-success mt-4">{{ __('Buscar Optisoft') }}</button>
                                    </form>   
                                </div>
                            </div>
                                                      
                            <form method="POST" action="{{ route('clientes.store') }}" autocomplete="off">                                
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="fechaCreacion"  value="<?php echo date("Y-m-d");?>">
                                <div class="pl-lg-4">                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-tipoDocumento">{{ __('Tipo de Documento') }}</label>
                                        <select id='tipoDocumento' class="form-control" id="input-tipoDocumento" type="text" name="tipoDocumento" placeholder="Tipo de Documento" value="{{$cliente->identification_type}}" required >
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
                                        <input id="documento" type="text" name="documento" id="input-documento" class="form-control form-control-alternative{{ $errors->has('documento') ? ' is-invalid' : '' }}" placeholder="{{ __('Documento') }}" value="{{$cliente->identification}}" required autofocus>

                                        @if ($errors->has('documento'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('documento') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-nombre">{{ __('Nombre') }}</label>
                                        <input type="text" name="nombre" id="input-nombre" class="form-control form-control-alternative{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" value="{{$cliente->first_name}} {{$cliente->first_name2}} {{$cliente->last_name}} {{$cliente->last_name2}} " required autofocus>

                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('celular') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-celular">{{ __('Celular') }}</label>
                                        <input type="text" name="celular" id="input-celular" class="form-control form-control-alternative{{ $errors->has('celular') ? ' is-invalid' : '' }}" placeholder="{{ __('Celular') }}" value="{{$cliente->mobile}}" required autofocus>

                                        @if ($errors->has('celular'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('celular') }}</strong>
                                            </span>
                                        @endif
                                    </div>  
                                    <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-telefono">{{ __('Teléfono') }}</label>
                                        <input type="text" name="telefono" id="input-telefono" class="form-control form-control-alternative{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Teléfono') }}" value="{{$cliente->phone}}" required autofocus>

                                        @if ($errors->has('telefono'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </div>                                  
                                    <div class="form-group{{ $errors->has('cumpleanos') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-cumpleanos">{{ __('Cumpleaños') }}</label>
                                        <input type="text" name="cumpleanos" id="input-cumpleanos" class="form-control form-control-alternative{{ $errors->has('cumpleanos') ? ' is-invalid' : '' }}" placeholder="{{ __('Cumpleaños') }}" value="{{$cliente->dob}}" required>

                                        @if ($errors->has('cumpleanos'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cumpleanos') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('correo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-correo">{{ __('Correo') }}</label>
                                        <input type="email" name="correo" id="input-correo" class="form-control form-control-alternative{{ $errors->has('correo') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo') }}" value="{{$cliente->email}}" required>
                                        
                                        @if ($errors->has('correo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('correo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('direccion') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-direccion">{{ __('Dirección') }}</label>
                                        <input type="text" name="direccion" id="input-direccion" class="form-control form-control-alternative{{ $errors->has('direccion') ? ' is-invalid' : '' }}" placeholder="{{ __('Dirección') }}" value="{{$cliente->address}}" required>
                                        
                                        @if ($errors->has('direccion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('municipio') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-municipio">{{ __('Municipio') }}</label>
                                        <input type="text" name="municipio" id="input-municipio" class="form-control form-control-alternative{{ $errors->has('municipio') ? ' is-invalid' : '' }}" placeholder="{{ __('Municipio') }}" value="" required>
                                        
                                        @if ($errors->has('municipio'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('municipio') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('observaciones') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-observaciones">{{ __('Observaciones') }}</label>
                                        <input type="text" style="height:10em" name="observaciones" id="input-observaciones" class="form-control form-control-alternative{{ $errors->has('observaciones') ? ' is-invalid' : '' }}" placeholder="{{ __('Observaciones') }}" value="{{$cliente->notes}}">
                                        
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
    <script>
      function getdata() 
      {
        document.getElementById("documentoSearch").value = document.getElementById("documento").value;
        document.getElementById("tipoDocumentoSearch").value = document.getElementById("tipoDocumento").value;
      }
      function getdata2() 
      {
        document.getElementById("documentoSearch2").value = document.getElementById("documento").value;
        document.getElementById("tipoDocumentoSearch2").value = document.getElementById("tipoDocumento").value;
      }
    </script>        
@endsection