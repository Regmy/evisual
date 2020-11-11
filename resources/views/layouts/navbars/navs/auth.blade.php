<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <p style="font-size:1.6vh">{{ __('Usuario: ')}} {{ __(auth()->user()->nombre)}} {{ __('|  Sede: ')}} {{ __(auth()->user()->sede->sede)}}</p>            
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
                {{ csrf_field() }}
                <div class="input-group no-border">                    
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                          <input type="checkbox" name="checkbox" data-toggle="tooltip" data-placement="bottom" title="Buscar en todas las sedes" aria-label="Checkbox para busqueda en todas las sedes">
                        </div>
                    </div>
                    <input id="inputSearchText" type="text" value="" name="searchText" class="form-control" placeholder="Documento..." data-toggle="tooltip" data-placement="bottom" title="Solo está habilitado para la lista de Clientes">
                    <input id="inputAccion" type="hidden" value="documento" name="accion" class="form-control">                    
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="nc-icon nc-zoom-split"></i>
                        </div>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" title="Tipos de Busqueda">
                        <i class="nc-icon nc-minimal-down"></i>
                        <p>
                            <span class="d-lg-none d-md-block">{{ __('Acciones') }}</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#" onclick="accion('documento')">{{ __('Documento') }}</a>
                        <a class="dropdown-item" href="#" onclick="accion('nombre')">{{ __('Nombre') }}</a>
                        <a class="dropdown-item" href="#" onclick="accion('telefono')">{{ __('Celular') }}</a>
                    </div>
                </li>
                <li class="nav-item btn-rotate dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-settings-gear-65"></i>
                        <p>
                            <span class="d-lg-none d-md-block">{{ __('Cuenta') }}</span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                        <form class="dropdown-item" action="{{ route('logout') }}" id="formLogOut" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" target="_blank" href="http://201.184.236.50:65124/optisoft/"> {{__('Optisoft')}} </a>
                            <a class="dropdown-item" onclick="document.getElementById('formLogOut').submit();">{{ __('Cerrar Sesión') }}</a>
                            @if (auth()->user()->rol =="adminisis" || auth()->user()->rol=="semiadministrador" )
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Mi Perfil') }}</a>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>
        </div>
</head>
</div>
    <script>
        function accion(accion)
        {
            document.getElementById('inputAccion').value = accion;
            
            if (accion == 'nombre') {
                document.getElementById('inputSearchText').placeholder="Nombre...";
            }
            if (accion == 'telefono') {
                document.getElementById('inputSearchText').placeholder="Celular...";
            } 
            if (accion == 'documento') {
                document.getElementById('inputSearchText').placeholder="Documento...";
            }
        }
    </script>
</nav>
