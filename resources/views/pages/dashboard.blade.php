@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

<style>
    .centrarimg{
    top: 0;
    max-width: 30%;
    position: absolute;
    margin-left: auto;
    margin-top: calc(50vh - 15%);
    }
</style>

@section('content')
    <div class="content" >
        <div class="container" style="padding-left: 17rem">
                <img src="{{ asset('paper') . '/' . ($backgroundImagePath ?? "img/logoofbk.png") }}" class="centrarimg" alt="Responsive image">
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
@endpush