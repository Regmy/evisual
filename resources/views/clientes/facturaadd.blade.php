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
                                    <h3 class="mb-0">{{ __('Agregar Producto a la Factura') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('ordenes.index', $cliente->id) }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                                </div>
                            </div>
                        </div>
                        @php
                            $part1= explode("-", $orden->fecha);
                            $nroOrden= $part1[0].$part1[1].$orden->id;
                        @endphp
                        <div class="card-body">
                            <form method="POST" action="{{ route('facturas.storeItem') }}" autocomplete="off"> 
                                <input type="hidden" name="_method" value="PUT">                               
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="idOrden" value="{{ $orden->id }}">
                                <input type="hidden" name="idCliente" value="{{ $orden->cliente_id }}">
                                <h6 class="heading-small mb-4"><label>{{ __('No.') }}</label> <label class="text-info">{{ __($nroOrden) }}</label> <label>{{ __('Cliente:') }}</label> <label class="text-info">{{ ($cliente->dato1) }}</label> <label>{{ __('  Documento:') }}</label> <label class="text-info">{{ ($cliente->dato2) }}</label></h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('producto') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Producto') }}</label>
                                        <input type="text" name="producto" id="input-producto" class="form-control form-control-alternative{{ $errors->has('producto') ? ' is-invalid' : '' }}" required autofocus>

                                        @if ($errors->has('producto'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('producto') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('descripcion') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-descripcion">{{ __('Descripción') }}</label>
                                        <input type="text" name="descripcion" id="input-descipcion" class="form-control form-control-alternative{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" required autofocus>

                                        @if ($errors->has('descripcion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('descripcion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('cantidad') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-cantidad">{{ __('Cantidad') }}</label>
                                        <input type="text" name="cantidad" id="input-cantidad" class="form-control form-control-alternative{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" required autofocus>

                                        @if ($errors->has('cantidad'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cantidad') }}</strong>
                                            </span>
                                        @endif
                                    </div>  
                                    <div class="form-group{{ $errors->has('precioUnitario') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-precioUnitario">{{ __('Precio Unitario') }}</label>
                                        <input type="text" name="precioUnitario" id="input-precioUnitario" class="form-control form-control-alternative{{ $errors->has('precioUnitario') ? ' is-invalid' : '' }}" required autofocus>

                                        @if ($errors->has('precioUnitario'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('precioUnitario') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-iva">{{ __('Grabado con iva?') }}</label>
                                        <select class="form-control" id="input-iva" type="text" name="iva" required >
                                              <option>No</option>
                                              <option>Si</option>
                                        </select>                                   
                                        <!--input type="text" name="nivelacceso" class="form-control" placeholder="Nivel de Acceso" value="{{ auth()->user()->name }}" required-->
                                        @if ($errors->has('iva'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('iva') }}</strong>
                                            </span>
                                         @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Agregar item a la Factura') }}</button>
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