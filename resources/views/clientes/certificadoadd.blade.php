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
                                    <h3 class="mb-0">{{ __('Agregar texto al PDF del certificado') }}</h3>
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
                            <form method="POST" action="{{ route('PDF.certificadoStore') }}" autocomplete="off"> 
                                <input type="hidden" name="_method" value="PUT">                               
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="idOrden" value="{{ $orden->id }}">
                                <input type="hidden" name="idCliente" value="{{ $orden->cliente_id }}">
                                <h6 class="heading-small mb-4"><label>{{ __('No.') }}</label> <label class="text-info">{{ __($nroOrden) }}</label> <label>{{ __('Cliente:') }}</label> <label class="text-info">{{ ($cliente->dato1) }}</label> <label>{{ __('  Documento:') }}</label> <label class="text-info">{{ ($cliente->dato2) }}</label></h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('texto') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Texto') }}</label>
                                        <textarea class="form-control" name="textoCertificado" aria-label="With textarea">{{ $texto }}</textarea>

                                        @if ($errors->has('texto'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('texto') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-tipo">{{ __('Tipo Certificado') }}</label>
                                        <select class="form-control" id="input-tipo" type="text" name="tipoCertificado" required >
                                            <option value={{$tipo}}>{{$tipo}}</option>
                                            <option value="">{{__('--')}}</option>
                                            <option>{{ __('EV I') }}</option>
                                            <option>{{ __('EV II') }}</option>
                                            <option>{{ __('EV III') }}</option>
                                            <option>{{ __('EV IV') }}</option>
                                            <option>{{ __('EV B') }}</option>
                                            <option>{{ __('EV Lente') }}</option>
                                        </select>                                   
                                        <!--input type="text" name="nivelacceso" class="form-control" placeholder="Nivel de Acceso" value="{{ auth()->user()->name }}" required-->
                                        @if ($errors->has('tipo'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('tipo') }}</strong>
                                            </span>
                                         @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Agregar Texto') }}</button>
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