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
                            <div class="col-6">
                                <h6 class="mb-0">{{ __('Consolidado de Todas las Sedes:') }}</h6>                                
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin.createFacturaRango') }}" class="btn btn-sm btn-primary">{{ __('Agregar Nueva Sede') }}</a>                                
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
                                    <th scope="col">{{ __('Sede') }}</th>
                                    <th scope="col">{{ __('Inicio') }}</th>
                                    <th scope="col">{{ __('Fin') }}</th>
                                    <th scope="col">{{ __('Leyenda') }}</th>
                                    <th scope="col">{{ __('Prefijo') }}</th>
                                    <th scope="col">{{ __('Resolución') }}</th>
                                    <th scope="col">{{ __('IVA') }}</th>
                                    <th scope="col">{{ __('Rango Recibo')}} <br> {{ __('Caja Inicio')}}</th>                                    
                                    <th scope="col">{{ __('Rango Recibo')}} <br> {{ __('Caja Fin')}}</th>                                    
                                    <th scope="col">{{ __('Acciones')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturaRangos as $facturaRango)                                                                          
                                    <tr>
                                        <td>{{ $facturaRango->id }}</td>
                                        <td style='background-color: orange; color: #ffffff; font-weight: bold'>{{ $facturaRango->sede }}</td>
                                        <td>{{ $facturaRango->inicio }}</td>
                                        <td>{{ $facturaRango->fin }}</td>
                                        <td>{{ $facturaRango->texto }}</td>                                    
                                        <td>{{ $facturaRango->prefijo }}</td>                                        
                                        <td>{{ $facturaRango->resolucion }}</td>                                        
                                        <td>{{ $facturaRango->iva }}</td>                                        
                                        <td>{{ $facturaRango->rango_rc_inicio }}</td>                                        
                                        <td>{{ $facturaRango->rango_rc_fin }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="nc-align-left-2 nc-icon"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('admin.deleteFacturaRango', $facturaRango->id) }}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">  
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                           
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('admin.editFacturaRango', $facturaRango->id) }}">{{ __('Ver/Editar Sede') }}</a>
                                                        <button type="button" class="dropdown-item" style="font-size: 0.8rem" onclick="confirm('{{ __("Al Eliminar esta Sede, los clientes relacionados a esta Sede 
                                                        seguirán dependientes de la misma, se recomienda Editar la sede, desea continuar?") }}') ? this.parentElement.submit() : ''">
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
                            {{ $facturaRangos->links() }}
                        </nav>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection