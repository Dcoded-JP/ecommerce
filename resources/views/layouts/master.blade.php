<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>Crafto - The Multipurpose HTML5 Template</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="ThemeZaa">
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <meta name="description" content="Elevate your online presence with Crafto - a modern, versatile, multipurpose Bootstrap 5 responsive HTML5, SCSS template using highly creative 52+ ready demos.">
        <!-- favicon icon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/apple-touch-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/apple-touch-icon-114x114.png') }}">
        <!-- google fonts preconnect -->
        <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- style sheets and font icons  -->
        <link rel="stylesheet" href="{{ asset('css/vendors.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/icon.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
        <link rel="stylesheet" href="{{ asset('demos/fashion-store/fashion-store.css') }}" />

        @stack('styles')
    </head>
    <body data-mobile-nav-style="classic">
        @include('includes.header')
        
        @yield('content')
        
        @include('includes.footer')
        <!-- start cookie message -->
        <div id="cookies-model" class="cookie-message bg-dark-gray border-radius-8px"> 
            <div class="cookie-description fs-14 text-white mb-20px lh-22">We use cookies to enhance your browsing experience, serve personalized ads or content, and analyze our traffic. By clicking "Allow cookies" you consent to our use of cookies. </div>   
            <div class="cookie-btn">
                <a href="#" class="btn btn-transparent-white border-1 border-color-transparent-white-light btn-very-small btn-switch-text btn-rounded w-100 mb-15px" aria-label="btn">
                    <span>
                        <span class="btn-double-text" data-text="Cookie policy">Cookie policy</span> 
                    </span>
                </a> 
                <a href="#" class="btn btn-white btn-very-small btn-switch-text btn-box-shadow accept_cookies_btn btn-rounded w-100" data-accept-btn aria-label="text">
                    <span>
                        <span class="btn-double-text" data-text="Allow cookies">Allow cookies</span> 
                    </span>
                </a>
            </div> 
        </div>
        <!-- end cookie message -->
        <!-- start sticky elements -->
        <div class="sticky-wrap z-index-1 d-none d-xl-inline-block" data-animation-delay="100" data-shadow-animation="true">
            <div class="elements-social social-icon-style-10">
                <ul class="fs-16">
                    <li class="me-30px"><a class="facebook" href="https://www.facebook.com/" target="_blank">
                            <i class="fa-brands fa-facebook-f me-10px"></i>
                            <span class="alt-font">Facebook</span>
                        </a>
                    </li> 
                    <li class="me-30px">
                        <a class="dribbble" href="http://www.dribbble.com" target="_blank">
                            <i class="fa-brands fa-dribbble me-10px"></i>
                            <span class="alt-font">Dribbble</span>
                        </a> 
                    </li>
                    <li class="me-30px">
                        <a class="twitter" href="http://www.twitter.com" target="_blank">
                            <i class="fa-brands fa-twitter me-10px"></i>
                            <span class="alt-font">Twitter</span>
                        </a>
                    </li>
                    <li>
                        <a class="instagram" href="http://www.instagram.com" target="_blank">
                            <i class="fa-brands fa-instagram me-10px"></i>
                            <span class="alt-font">Instagram</span>
                        </a> 
                    </li>
                </ul>
            </div>
        </div>
        <!-- end sticky elements -->
        <!-- start scroll progress -->
        <div class="scroll-progress d-none d-xxl-block">
            <a href="#" class="scroll-top" aria-label="scroll">
                <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
            </a>
        </div>
        <!-- end scroll progress -->
        <!-- javascript libraries -->
        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vendors.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        @stack('scripts')
    </body>
</html>
