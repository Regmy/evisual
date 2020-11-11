@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'facturadd',
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
                                    <h3 class="mb-0">{{ __('Editar Sede') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('admin.sede') }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.updateFacturaRango',$facturaRango->id_fct) }}" autocomplete="off" accept-charset="UTF-8" enctype="multipart/form-data"> 
                                <input type="hidden" name="_method" value="PUT">                               
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                            
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('sede') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Sede') }}</label><br>
                                    <input type="text" name="sede" id="input-sede" class="form-control form-control-alternative{{ $errors->has('sede') ? ' is-invalid' : '' }}" placeholder="" value="{{$facturaRango->sede}}" required>                                        
                                        @if ($errors->has('sede'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('sede') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('inicio') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Inicio de la Resolución') }}</label><br>
                                        <input type="number" name="inicio" id="input-inicio" class="form-control form-control-alternative{{ $errors->has('inicio') ? ' is-invalid' : '' }}" placeholder="" value="{{$facturaRango->inicio}}" required>                                        
                                        @if ($errors->has('inicio'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('inicio') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('fin') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Fin de la Resolución') }}</label><br>
                                        <input type="number" name="fin" id="input-fin" class="form-control form-control-alternative{{ $errors->has('fin') ? ' is-invalid' : '' }}" placeholder="" value="{{$facturaRango->fin}}" required>                                        
                                        @if ($errors->has('fin'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('fin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('leyenda') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Leyenda') }}</label><br>
                                        <textarea name="texto" id="input-leyenda" aria-label="With textarea" class="form-control form-control-alternative{{ $errors->has('leyenda') ? ' is-invalid' : '' }}" required >{{$facturaRango->texto}}</textarea>
                                        @if ($errors->has('leyenda'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('leyenda') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('prefijo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Prefijo') }}</label><br>
                                        <input type="text" name="prefijo" id="input-prefijo" class="form-control form-control-alternative{{ $errors->has('prefijo') ? ' is-invalid' : '' }}" placeholder="" value="{{$facturaRango->prefijo}}" required>                                        
                                        @if ($errors->has('prefijo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('prefijo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('resolucion') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Resolución') }}</label><br>
                                        <textarea name="resolucion" id="input-resolucion" aria-label="With textarea" class="form-control form-control-alternative{{ $errors->has('resolucion') ? ' is-invalid' : '' }}" required >{{$facturaRango->resolucion}}</textarea>                                        
                                        @if ($errors->has('resolucion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('resolucion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('iva') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('IVA') }}</label><br>
                                        <input type="number" name="iva" id="input-iva" class="form-control form-control-alternative{{ $errors->has('iva') ? ' is-invalid' : '' }}" placeholder="" value="{{$facturaRango->iva}}" required>                                        
                                        @if ($errors->has('iva'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('iva') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('rangoInicio') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Rango Recibo de Caja Inicio') }}</label><br>
                                        <input type="number" name="rangoInicio" id="input-rangoInicio" class="form-control form-control-alternative{{ $errors->has('rangoInicio') ? ' is-invalid' : '' }}" placeholder="" value="{{$facturaRango->rango_rc_inicio}}" required>                                        
                                        @if ($errors->has('rangoInicio'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rangoInicio') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('rangoFin') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Rango Recibo de Caja Fin') }}</label><br>
                                        <input type="number" name="rangoFin" id="input-rangoFin" class="form-control form-control-alternative{{ $errors->has('rangoFin') ? ' is-invalid' : '' }}" placeholder="" value="{{$facturaRango->rango_rc_fin}}" required>                                        
                                        @if ($errors->has('rangoFin'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rangoFin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('textoDevolucion') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Texto Devolución') }}</label><br>
                                        <textarea name="textoDevolucion" id="input-textoDevolucion" aria-label="With textarea" class="form-control form-control-alternative{{ $errors->has('textoDevolucion') ? ' is-invalid' : '' }}" required >{{$facturaRango->texto_devolucion}}</textarea>                                                                          
                                        @if ($errors->has('textoDevolucion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('textoDevolucion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('textoHorarios') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Texto Horarios') }}</label><br>
                                        <textarea name="textoHorarios" id="input-textoHorarios" aria-label="With textarea" class="form-control form-control-alternative{{ $errors->has('textoHorarios') ? ' is-invalid' : '' }}" required >{{$facturaRango->texto_horarios}}</textarea>                                        
                                        @if ($errors->has('textoHorarios'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('textoHorarios') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroupFile01" style="padding: 0px;">
                                            <label class="form-control-label" for="input-producto" style="padding-right: 2rem; font-size: 0.7571em"> {{ __('Logo') }}</label>                                          
                                        </span>
                                        </div>
                                        <div class="custom-file">                                        
                                        <input type="file" name="imagenLogo" id="inputGroupFile01" aria-describedby="inputGroupFile01">
                                          {{-- <label class="custom-file-label" for="inputGroupFile01" value="inputGroupFile01">{{ __('Seleccionar Archivo') }}</label> --}}                                          
                                        </div>                                        +
                                    </div>
                                    <img src="{{ asset("img/facturas/$facturaRango->imagen_logo") }}" style="max-height: 120px; max-width:210px; text-align: left" />
                                    <br>
                                    <label>{{__('Logo Anterior:')}} {{$facturaRango->imagen_logo}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroupFile02" style="padding: 0px;">
                                            <label class="form-control-label" for="input-producto" style="padding-right: 2rem; font-size: 0.7571em; max-height: 150px "> {{ __('Imagen Datos') }}</label>                                          
                                        </span>
                                        </div>
                                        <div class="custom-file">                                            
                                          <input type="file" name="imagenDatos"  id="inputGroupFile02" aria-describedby="inputGroupFile02">
                                          {{-- <label class="custom-file-label" for="inputGroupFile02">{{ __('Seleccionar Archivo') }}</label> --}}                                          
                                        </div>
                                    </div>
                                    <img src="{{ asset("img/facturas/$facturaRango->imagen_datos") }}"  style="max-height: 105px"/>  
                                    <br>
                                    <label>{{__('Imagen Datos Anterior:')}} {{$facturaRango->imagen_datos}}</label>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Actualizar') }}</button>
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