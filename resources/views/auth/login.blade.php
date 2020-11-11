@extends('layouts.app', [
    'class' => 'login-page',
    'backgroundImagePath' => 'img/bg/fabio-mangione.jpg'
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto" style="text-align: center">
                <form class="form " method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <img src="{{ asset('paper') . '/' . ($backgroundImagePath ?? "img/logoofbk.png") }}" class="figure-img" alt="Responsive image" style="max-width: 45%">                             
                    <div class="card card-login ">
                        <div class="card-header ">
                            <div class="card-header ">
                                <h3 class="header text-center">{{ __('Inicia Sesión') }}</h3>
                                <h6 class="text-center"> Ingresa con tus credenciales</h6>
                            </div>
                        </div>
                        <div class="card-body ">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-single-02"></i>
                                    </span>
                                </div>
                                <input class="form-control{{ $errors->has('documento') ? ' is-invalid' : '' }}" placeholder="{{ __('Usuario') }}" type="text" name="documento" value="{{ old('documento') }}" required autofocus>
                                
                                @if ($errors->has('documento'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('documento') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="nc-icon nc-lock-circle-open"></i>
                                    </span>
                                </div>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Contraseña') }}" type="password" required>
                                
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="form-check" style="text-align: left">
                                     <label class="form-check-label">
                                        <input class="form-check-input" name="remember" type="checkbox" value="" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-sign"></span>
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-warning btn-round mb-3">{{ __('Entrar') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--<a href="{{ route('password.request') }}" class="btn btn-link">
                    <div class="d-none d-sm-none d-md-block">
                        {{ __('') }}
                    </div> 
                </a>-->
                <!--<a href="{{ route('register') }}" class="btn btn-link float-right">
                    <div class="d-none d-sm-none d-md-block">
                        {{ __('Powered by Domitecno') }}
                    </div> -->
                    <div class="text-primary text-muted text-center">Powered By Domitecno</div>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush

