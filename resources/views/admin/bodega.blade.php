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
                                <h6 class="mb-0">{{ __('Consolidado:') }} <label class="mb-0" style="color: #FFA500">{{ __('Bodega') }} </label> </h6> 
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin.createBodega') }}" class="btn btn-sm btn-primary">{{ __('Agregar Nuevo Item') }}</a>
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
                                    <th scope="col">{{ __('ID') }}</th>
                                    <th scope="col">{{ __('Cantidad') }}</th>
                                    <th scope="col">{{ __('Bodega') }}</th>
                                    <th scope="col">{{ __('Referencia') }}</th>
                                    <th scope="col">{{ __('Código') }}</th>
                                    <th scope="col">{{ __('Grupo o Familia') }}</th>
                                    <th scope="col">{{ __('Marca') }}</th>
                                    <th scope="col">{{ __('Manifiesto') }}</th>
                                    <th scope="col">{{ __('Costo')}}</th>                                    
                                    <th scope="col">{{ __('Precio')}}</th>
                                    <th scope="col">{{ __('Tipo')}}</th>
                                    <th scope="col">{{ __('Material')}}</th>
                                    <th scope="col">{{ __('Unidad de Medida')}}</th>
                                    <th scope="col">{{ __('INVIMA')}}</th>
                                    <th scope="col">{{ __('Lote')}}</th>
                                    <th scope="col">{{ __('Color')}}</th>
                                    <th scope="col">{{ __('Acciones')}}</th>
                                </tr>
                            </thead>                           
                            <tbody>
                                @foreach ($bodegas as $bodega)                                                                          
                                    <tr>
                                        <td>{{ $bodega->id_bdg }}</td>
                                        <td style='background-color: orange; color: #ffffff; font-weight: bold'>{{ $bodega->cantidad }}</td>
                                        <td style='background-color: orange; color: #ffffff; font-weight: bold'>{{ $bodega->bodega }}</td>
                                        <td>{{ $bodega->referencia }}</td>
                                        <td>{{ $bodega->codigo }}</td>
                                        <td>{{ $bodega->grupo_familia }}</td>                                    
                                        <td>{{ $bodega->marca }}</td>                                        
                                        <td>{{ $bodega->manifiesto }}</td>                                        
                                        <td>{{ $bodega->costo }}</td>                                        
                                        <td>{{ $bodega->precio }}</td>                                        
                                        <td>{{ $bodega->tipo }}</td>
                                        <td>{{ $bodega->material }}</td>
                                        <td>{{ $bodega->unidad_de_medida }}</td>
                                        <td>{{ $bodega->invima }}</td>
                                        <td>{{ $bodega->lote }}</td>
                                        <td>{{ $bodega->color }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="nc-align-left-2 nc-icon"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('admin.deleteBodega', $bodega->id_bdg) }}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">  
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                           
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('admin.editBodega', $bodega->id_bdg) }}">{{ __('Ver/Editar Datos') }}</a>
                                                        <button type="button" class="dropdown-item" style="font-size: 0.8rem" onclick="confirm('{{ __("Esta seguro de eliminar esta Bodega?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Eliminar') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>                                           
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $bodegas->links() }}
                        </nav>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection