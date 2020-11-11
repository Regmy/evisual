@extends('layouts.app', [
    'class' => 'login-page',
    'elementActive' => ''
])

{{-- Estilos Customs --}}

<style>
    .centrarimg{
        width: 30%;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>

{{-- Codigo --}}

@section('content')
    <div class="content col-md-12 ml-auto mr-auto">
        <div class="header py-5 pb-7 pt-lg-9"> 
            <div class="container col-md-5" style="text-align: center" >
                <img src="{{ asset('paper') . '/' . ($backgroundImagePath ?? "img/logoofbk.png") }}" class="figure-img" alt="Responsive image" style="max-width: 50%"> 
                <img src="{{ asset($backgroundImagePath ?? "img/aniversarioev.png") }}" class="figure-img centrarimg" alt="Responsive image"> 
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">                        
                        <div class="col-lg-8 col-md-12 pt-5">
                            <h1 class="@if(Auth::guest()) text-dark @endif">{{ __('') }}</h1>
                            <p class="@if(Auth::guest()) text-dark @endif text-lead mt-3 mb-0">
                                {{ __('') }}
                            </p>
                        </div>
                    </div>
                </div>
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
