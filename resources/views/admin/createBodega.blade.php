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
                                    <h3 class="mb-0">{{ __('Agregar un Nuevo Item en Bodega') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('admin.bodega')}}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.storeBodega') }}" autocomplete="off"> 
                                <input type="hidden" name="_method" value="PUT">                               
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                            
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('cantidad') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Cantidad') }}</label><br>
                                        <input type="number" name="cantidad" id="input-cantidad" class="form-control form-control-alternative{{ $errors->has('cantidad') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('cantidad'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cantidad') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('bodega') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Bodega') }}</label><br>
                                        <input type="text" name="bodega" id="input-bodega" class="form-control form-control-alternative{{ $errors->has('bodega') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('bodega'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('bodega') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('referencia') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Referencia') }}</label><br>
                                        <input type="text" name="referencia" id="input-referencia" class="form-control form-control-alternative{{ $errors->has('referencia') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('referencia'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('referencia') }}</strong>
                                            </span>
                                        @endif
                                    <div class="form-group{{ $errors->has('codigo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Codigo') }}</label><br>
                                        <input type="text" name="codigo" id="input-codigo" class="form-control form-control-alternative{{ $errors->has('codigo') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('codigo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('codigo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('grupoFamilia') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Grupo Familia') }}</label><br>
                                        <input type="text" name="grupoFamilia" id="input-grupoFamilia" class="form-control form-control-alternative{{ $errors->has('grupoFamilia') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('grupoFamilia'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('grupoFamilia') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('marca') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Marca') }}</label><br>
                                        <input type="text" name="marca" id="input-marca" class="form-control form-control-alternative{{ $errors->has('marca') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('marca'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('marca') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('manifiesto') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Manifiesto') }}</label><br>
                                        <input type="text" name="manifiesto" id="input-manifiesto" class="form-control form-control-alternative{{ $errors->has('manifiesto') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('manifiesto'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('manifiesto') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('costo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Costo') }}</label><br>
                                        <input type="text" name="costo" id="input-costo" class="form-control form-control-alternative{{ $errors->has('costo') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('costo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('costo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('precio') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Precio') }}</label><br>
                                        <input type="text" name="precio" id="input-precio" class="form-control form-control-alternative{{ $errors->has('precio') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('precio'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('precio') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Tipo') }}</label><br>
                                        <input type="text" name="tipo" id="input-tipo" class="form-control form-control-alternative{{ $errors->has('tipo') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('tipo'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('tipo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('material') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Material') }}</label><br>
                                        <input type="text" name="material" id="input-material" class="form-control form-control-alternative{{ $errors->has('material') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('material'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('material') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('unidadMedida') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Unidad de Medida') }}</label><br>
                                        <input type="text" name="unidadMedida" id="input-unidadMedida" class="form-control form-control-alternative{{ $errors->has('unidadMedida') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('unidadMedida'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('unidadMedida') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('invima') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('INVIMA') }}</label><br>
                                        <input type="text" name="invima" id="input-invima" class="form-control form-control-alternative{{ $errors->has('invima') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('invima'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('invima') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('lote') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Lote') }}</label><br>
                                        <input type="text" name="lote" id="input-lote" class="form-control form-control-alternative{{ $errors->has('lote') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('lote'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lote') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('color') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-producto"> {{ __('Color') }}</label><br>
                                        <input type="text" name="color" id="input-color" class="form-control form-control-alternative{{ $errors->has('color') ? ' is-invalid' : '' }}" placeholder="" value="" required>                                        
                                        @if ($errors->has('color'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('color') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Crear') }}</button>
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