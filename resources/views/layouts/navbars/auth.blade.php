<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="{{ route('page.index', 'dashboard') }}" class="simple-text logo-normal">
            {{ __('Evolución Visual') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        {{ csrf_field() }}
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Menú') }}</p>
                </a>
            </li>
            @if (auth()->user()->rol =="adminisis" || auth()->user()->rol=="semiadministrador" )
                <li class="{{ $elementActive == 'cartera' || $elementActive == 'bodega' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#desgloceadmin">
                        <i class="nc-icon nc-settings"></i>
                        <p>
                                {{ __('Admin') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="desgloceadmin">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'cartera' ? 'active' : '' }}">
                                <a href="{{ route('admin.clientesConsolidado') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __('Consolidado de clientes') }} <br> <div class="text-center">{{ __('todas las sedes') }}</div></span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'cartera' ? 'active' : '' }}">
                                <a href="{{ route('admin.cartera') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Cartera ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'sedes' ? 'active' : '' }}">
                                <a href="{{ route('admin.sede') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Sedes ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'bodega' ? 'active' : '' }}">
                                <a href="{{ route('admin.bodega') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Bodega ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'ListaSelec' ? 'active' : '' }}">
                                <a href="{{ route('admin.seleccionables', 'user') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __('Listas') }} <br> <div class="text-center">{{ __('Seleccionables') }}</div> </span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'Modify' ? 'active' : '' }}">
                                <a href='user/modify/'>
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __('Modify') }} <br></span>
                                </a>
                            </li>
                            {{-- <li class="{{ $elementActive == 'bodega' ? 'active' : '' }}">
                                <a href="{{ route('page.index', 'user') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Generar Backup ') }}</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'inforFilt' || $elementActive == 'inforGaran' || $elementActive == 'inforCot' || $elementActive == 'inforTMes' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#desgloceinforme">
                        <i class="nc-icon nc-paper"></i>
                        <p>
                                {{ __('Informes') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="desgloceinforme">
                        <ul class="nav">
                            <li class="{{ $elementActive == 'inforFilt' ? 'active' : '' }}">
                                <a href="{{ route('admin.informeFiltro') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Filtros ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'inforGaran' ? 'active' : '' }}">
                                <a href="{{ route('admin.informeGarantia') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Garantías ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'inforCot' ? 'active' : '' }}">
                                <a href="{{ route('admin.informeCotizacion') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Cotizaciones ') }}</span>
                                </a>
                            </li>
                            <li class="{{ $elementActive == 'inforTMes' ? 'active' : '' }}">
                                <a href="{{ route('admin.informeOrdenMes') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' TotalMes ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="true" href="#desgloceuser">
                        <i class="nc-icon nc-circle-10"></i>
                        <p> {{ __('Usuarios') }}
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="desgloceuser">
                        <ul class="nav">
                            {{-- <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                                <a href="{{ route('profile.edit') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Perfil de Usuario ') }}</span>
                                </a>
                            </li> --}}
                            <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                                <a href="{{ route('page.index', 'user') }}">
                                    <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                    <span class="sidebar-normal">{{ __(' Gestión de Usuarios ') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            <li class="{{ $elementActive == 'clientes' || $elementActive=='create' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#desglocecliente">
                    <i class="nc-icon nc-single-02"></i>
                    <p>
                            {{ __('Clientes') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="desglocecliente">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'clientes' ? 'active' : '' }}">
                            <a href="{{ route('clientes.index') }}">
                                <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                <span class="sidebar-normal">{{ __(' Lista de Clientes ') }}</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav">
                        <li class="{{ $elementActive == 'create' ? 'active' : '' }}">
                            <a href="{{ route('clientes.create') }}">
                                <span class="sidebar-mini-icon">{{ __('>') }}</span>
                                <span class="sidebar-normal">{{ __(' Nuevo Cliente ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Iconos') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Notificaciones') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Lista de Tablas') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'typography' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Tipografía') }}</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>