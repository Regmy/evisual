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
                                    <h3 class="mb-0">{{ __('Agregar Abono') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('abono.index', $orden->id) }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                                </div>
                            </div>
                        </div>
                        @php
                            $part1= explode("-", $orden->fecha);
                            $nroOrden= $part1[0].$part1[1].$orden->id;
                        @endphp
                        <div class="card-body">
                            <form method="POST" action="{{ route('abono.store') }}" autocomplete="off"> 
                                <input type="hidden" name="_method" value="PUT">                               
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="idOrden" value="{{ $orden->id }}">
                                <input type="hidden" name="idCliente" value="{{ $orden->cliente_id }}">
                                <h6 class="heading-small mb-4"><label>{{ __('No.') }}</label> <label class="text-info">{{ __($nroOrden) }}</label> <label>{{ __('Cliente:') }}</label> <label class="text-info">{{ ($cliente->dato1) }}</label> <label>{{ __('  Documento:') }}</label> <label class="text-info">{{ ($cliente->dato2) }}</label></h6>
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('abono') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Abono') }}</label><br>
                                        <input type="number" name="abono" id="input-abono" class="form-control form-control-alternative{{ $errors->has('abono') ? ' is-invalid' : '' }}" placeholder="" value="" required>
                                        {{-- <input type="number" name="abono" value=""> --}}
                                        @if ($errors->has('abono'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('abono') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('formaPago') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Forma de Pago') }}</label><br>
                                        <input type="text" name="formaPago" id="input-formaPago" class="form-control form-control-alternative{{ $errors->has('formaPago') ? ' is-invalid' : '' }}" placeholder="" value="" required>
                                        {{-- <input type="number" name="formaPago" value=""> --}}
                                        @if ($errors->has('formaPago'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('formaPago') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Ingrsar Abono') }}</button>
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