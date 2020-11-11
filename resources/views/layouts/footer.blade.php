<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav text-dark">
                <ul>
                    <li>
                        <a href="#" target="_blank">{{ __('Contacto') }}</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">{{ __('Soporte') }}</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">{{ __('Blog') }}</a>
                    </li>
                    <li>
                        <a href="#" target="_blank">{{ __('Politicas') }}</a>
                    </li>
                </ul>
            </nav>
            <div class="credits ml-auto text-dark">
                <span class="copyright">
                    ©
                    <script>
                         document.write(new Date().getFullYear())
                    </script>
                    <a class="@if(Auth::guest()) @endif text-dark" href="http://domitecno.com.co/" target="_blank">{{ __('domitecno.com.co') }}</a>
                    {{-- {{ __('- 2024 , Echo con ') }}<i class="fa fa-heart heart"></i>{{ __(' por ') }}<a class="@if(Auth::guest()) @endif text-dark" href="#" target="_blank">{{ __('R.N') }}</a>{{ __(' y ') }}<a class="@if(Auth::guest()) @endif" target="_blank" href="#">{{ __('....') }}</a> --}}
                </span> 
            </div>
        </div>
    </div>
</footer>