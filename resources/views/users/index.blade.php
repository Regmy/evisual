@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'user'
])

@section('content')
    <div class="content">        
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Usuarios') }}</h3>
                                </div>
                                <div class="col-6 col-sm-4 text-right">
                                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Nuevo Usuario') }}</a>
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
                            @if (session('badStatus'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('badStatus') }}
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
                                        <th scope="col">{{ __('Nombre') }}</th>
                                        <th scope="col">{{ __('Documento') }}</th>
                                        <th scope="col">{{ __('Rol') }}</th>
                                        <th scope="col">{{ __('Sede') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->nombre }}</td>
                                            <td>{{ $user->documento }}</td>
                                            <td>{{ $user->rol }}</td>
                                            <td>{{ $user->sede->sede }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="nc-align-left-2 nc-icon"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @if ($user->id != auth()->id())
                                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                         
                                                                <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">{{ __('Editar') }}</a>
                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Esta seguro de eliminar este Usuario?") }}') ? this.parentElement.submit() : ''">
                                                                    {{ __('Eliminar') }}
                                                                </button>
                                                            </form>    
                                                        @else
                                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Editar') }}</a>
                                                        @endif
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
                                {{ $users->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection