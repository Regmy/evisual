@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'orden'
])

@section('content')
<div class="content">        
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <h6 class="mb-0">{{ __('Edición de Campos de la Orden') }}</h6>
                                <h6 class="mb-0" style="color: #FFA500">{{ __('Seleccionables') }}</h6>
                                <br>
                            </div>
                        </div>
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
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Campo') }}</th>
                                    <th scope="col">{{ __('Valores Actuales') }}</th>
                                    <th scope="col">{{ __('Agregar') }}</th>
                                    <th scope="col">{{ __('Eleminar') }}</th>
                                </tr>
                            </thead>
                            <tbody>                                                                        
                                <tr>
                                    <td>{{ __('Médico') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="medicol" name="medicol">
                                                @foreach ($seleccionables->medicol as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('medicol'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('medicol') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->medicol[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->medicol as $medicol2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $medicol2['id']) }}">{{ $medicol2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Fórmula Cilindro') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="cilindro" name="cilindro">
                                                @foreach ($seleccionables->cilindro as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('cilindro'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('cilindro') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->cilindro[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->cilindro as $cilindro2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $cilindro2['id']) }}">{{ $cilindro2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Fórmula Esfera') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="esfera" name="esfera">
                                                @foreach ($seleccionables->esfera as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('esfera'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('esfera') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->esfera[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->esfera as $esfera2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $esfera2['id']) }}">{{ $esfera2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Fórmula Adición') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="adicion" name="adicion">
                                                @foreach ($seleccionables->adicion as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('adicion'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('adicion') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->adicion[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->adicion as $adicion2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $adicion2['id']) }}">{{ $adicion2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Fórmula Lente') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="lente" name="lente">
                                                @foreach ($seleccionables->lente as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('lente'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('lente') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->lente[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->lente as $lente2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $lente2['id']) }}">{{ $lente2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Fórmula Bisel') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="bisel" name="bisel">
                                                @foreach ($seleccionables->bisel as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('bisel'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('bisel') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->bisel[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->bisel as $bisel2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $bisel2['id']) }}">{{ $bisel2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Fórmula Lab') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="lab" name="lab">
                                                @foreach ($seleccionables->lab as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('lab'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('lab') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->lab[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->lab as $lab2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $lab2['id']) }}">{{ $lab2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Lente Clase de Progresivo') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="claseProgresivol" name="claseProgresivol">
                                                @foreach ($seleccionables->claseProgresivol as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('claseProgresivol'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('claseProgresivol') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->claseProgresivol[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->claseProgresivol as $claseProgresivol2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $claseProgresivol2['id']) }}">{{ $claseProgresivol2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Lente Tratamiento') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="tratamientol" name="tratamientol">
                                                @foreach ($seleccionables->tratamientol as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('tratamientol'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('tratamientol') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->tratamientol[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->tratamientol as $tratamientol2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $tratamientol2['id']) }}">{{ $tratamientol2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Lente Material') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="materiall" name="materiall">
                                                @foreach ($seleccionables->materiall as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('materiall'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('materiall') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->materiall[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->materiall as $materiall2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $materiall2['id']) }}">{{ $materiall2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Lente Tipo') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="tipol" name="tipol">
                                                @foreach ($seleccionables->tipol as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('tipol'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('tipol') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->tipol[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->tipol as $tipol2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $tipol2['id']) }}">{{ $tipol2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Color LTE') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="colorLtel" name="colorLtel">
                                                @foreach ($seleccionables->colorLtel as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('colorLtel'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('colorLtel') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->colorLtel[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->colorLtel as $colorLtel2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $colorLtel2['id']) }}">{{ $colorLtel2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Color Montura') }}</td>
                                    <td scope="row" class="" style="height: 4rem" >
                                        <div class="form-group">
                                            <select class="form-control" type="text" id="colorMontm" name="colorMontm">
                                                @foreach ($seleccionables->colorMontm as $parametro)
                                                    <option>{{$parametro['option_value']}}</option>                                                    
                                                @endforeach                                               
                                            </select>                                   
                                            @if ($errors->has('colorMontm'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('colorMontm') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.createSelec') }}" autocomplete="off"> 
                                            <input type="hidden" name="_method" value="PUT">                               
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="seleccion" value={{$seleccionables->colorMontm[0]['campo']}}>
                                            <input type="text" name="newSeleccion" style="width: 7rem;">
                                            <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Crear') }}</button>
                                        </form> 
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="nc-align-left-2 nc-icon"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.createSelec') }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    @foreach ($seleccionables->colorMontm as $colorMontm2)
                                                        <a class="dropdown-item py-1" style="font-size: 0.6rem"  href="{{ route('admin.deleteSelec', $colorMontm2['id']) }}">{{ $colorMontm2['option_value'] }}</a>                                                        
                                                    @endforeach                                                           
                                                </form>
                                            </div>
                                        </div>                                           
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection