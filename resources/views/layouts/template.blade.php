<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="image/favicon.png" type="image/png">
        <title>Hotel BD</title>

        <link rel="stylesheet" href="app.css">
        <script src="app.js"></script>
        <!-- Bootstrap CSS -->
            <!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('template/vendors/linericon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/vendors/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/vendors/nice-select/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('template/vendors/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/loading.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/all.css') }}"> --}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <!-- main css -->
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('template/css/responsive.css') }}">
    </head>
    <body>

        <!-- Loding website -->


        
<!-- End Loding website -->


        <!--================Header Area =================-->
        <header class="header_area">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ route('landing') }}"><h5>HOTEL BD</h5></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">

                            <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#facilities">Facilities</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">About us</a></li>
                            @guest
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-out-alt"></i> Login/Register</a></li>
                            @else
                                <li class="nav-item submenu dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                    </a>

                                    <ul class="dropdown-menu">
                                        @if (Auth::user()->role == "customer")

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('customer.transactions') }}"><i class="fas fa-exchange-alt"></i>
                                                    List Transactions
                                                </a>
                                            </li>
                                        @endif

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                            </a>
                                        </li>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--================Header Area =================-->
        @yield('content')

        <footer class="footer-area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4  col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">About Agency</h6>
                            <p>The world has become so fast paced that people don’t want to stand by reading a page of information, they would much rather look at a presentation and understand the message. It has come to a point </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6 class="footer_title">Newsletter</h6>
                            <p>For business professionals caught between high OEM price and mediocre print and graphic output, </p>
                            <div id="mc_embed_signup">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget instafeed text-center">
                            <h6 class="footer_title">InstaFeed</h6>
                            <ul class="list_style instafeed d-flex flex-wrap justify-content-center">
                                <li class="m-2">
                                    <img src="{{ asset('template/image/instagram/Image-01.png') }}" alt="Image 01" class="img-fluid" style="height: 100px; width: 100px;">
                                    <p>Raihan Patowary</p>
                                </li>
                                <li class="m-2">
                                    <img src="{{ asset('template/image/instagram/Image-02.png') }}" alt="Image 02" class="img-fluid" style="height: 100px; width: 100px;">
                                    <p>Sharmin Sultana</p>
                                </li>
                                <li class="m-2">
                                    <img src="{{ asset('template/image/instagram/Image-03.png') }}" alt="Image 03" class="img-fluid" style="height: 100px; width: 100px;">
                                    <p>Osim Kumar Roy</p>
                                </li>
                                <li class="m-2">
                                    <img src="{{ asset('template/image/instagram/Image-04.png') }}" alt="Image 04" class="img-fluid" style="height: 100px; width: 100px;">
                                    <p>Kawsar Hossan</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="border_line"></div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-8 col-sm-12 footer-text m-0">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright ©<script>document.write(new Date().getFullYear());</script> All rights reserved
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                    <div class="col-lg-4 col-sm-12 footer-social">
                        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.dribbble.com" target="_blank"><i class="fab fa-dribbble"></i></a>
                        <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </footer>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('template/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('template/js/popper.js') }}"></script>
        <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('template/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('template/js/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('template/js/mail-script.js') }}"></script>
        <script src="{{ asset('template/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js') }}"></script>
        <script src="{{ asset('template/vendors/nice-select/js/jquery.nice-select.js') }}"></script>
        <script src="{{ asset('template/js/mail-script.js') }}"></script>
        <script src="{{ asset('template/js/stellar.js') }}"></script>
        <script src="{{ asset('template/vendors/lightbox/simpleLightbox.min.js') }}"></script>
        <script src="{{ asset('template/js/custom.js') }}"></script>
        <script src="{{ asset('template/js/loading.js') }}"></script>
        @yield('script')
        <script>
            setTimeout(function() {
                $('.alert').fadeOut('fast');
            }, 3000); // <-- time in milliseconds
        </script>

        <!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
