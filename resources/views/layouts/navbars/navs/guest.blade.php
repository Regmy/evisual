<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container ">
        <div class="navbar-wrapper">
            <div class="navbar-toggle ">
                <button type="button " class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1" ></span>
                    <span class="navbar-toggler-bar bar2" ></span>
                    <span class="navbar-toggler-bar bar3" ></span>
                </button>
            </div>
            <a class="navbar-brand" href="/">{{ __('Bienvenido') }}</a>            
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab " ></span>
            <span class="navbar-toggler-bar navbar-kebab" ></span>
            <span class="navbar-toggler-bar navbar-kebab" ></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="navigation">
            <ul class="navbar-nav ">
                <!--<li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                    <i class="nc-icon nc-layout-11"></i> {{ __('') }}
                    </a>
                </li>-->
                <li class="nav-item ">
                    <a href="http://201.184.236.50:65124/optisoft/" class="nav-link">
                    <i class="nc-icon nc-book-bookmark"></i>{{ __('Optisoft') }}
                    </a>
                </li>
                <li class="nav-item  active ">
                    <a href="{{ route('login') }}" class="nav-link">
                    <i class="nc-icon nc-tap-01"></i>{{ __('Iniciar Sesión') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>