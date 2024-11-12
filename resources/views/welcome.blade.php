<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cotiz descubre nuestros mejores eventos y agenda una llamada con nuestros mejores mentores.">
    <meta name="keywords" content="Mentorias, Eventos, Inversiones, Startups, DQV, Ross Digital">
    <meta name="author" content="Ross Digital">
    <meta name="website" content="" />
    <meta name="email" content="" />
    <title>Cotiz | WebSite</title>
    <meta name="version" content="1.6.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <!-- Css -->
    <link href="{{ asset('web/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('web/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <!-- Main Css -->
    <link rel="stylesheet" href="{{ asset('web/libs/@iconscout/unicons/css/line.css') }}"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('web/css/icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/tailwind.css') }}" />
</head>

<body class="font-nunito text-base text-black dark:text-white dark:bg-slate-900">
    <!-- Loader Start
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    Loader End -->

    <nav id="topnav" class="defaultscroll is-sticky bg-white dark:bg-slate-900">
        <div class="container">
            <!-- Logo container-->
            <a class="logo ltr:pl-0 rtl:pr-0" href="">
                <img src="{{ asset('web/images/logo-cotiz.png') }}" style="width: 150px;"
                    class="inline-block dark:hidden" alt="">
                <img src="{{ asset('web/images/logo-cotiz.png') }}" style="width: 150px;"
                    class="hidden dark:inline-block" alt="">
            </a>

            <!--Login button Start-->

            <ul class="buy-button list-none mb-0">
                <li class="inline mb-0">
                    <a href="javascript:void(0)" class="btn btn-icon rounded-full hover:text-black">
                        <i data-feather="phone" class="h-4 w-4"></i>
                    </a>
                </li>

            </ul>
            <!--Login button End-->
        </div>
        <!--end container-->
    </nav>

    <!-- Main -->
    <main>
        <!-- Start Hero -->
        <section class="md:h-screen py-36 h-auto relative flex items-center background-effect overflow-hidden"
            style="background-image: url('{{ asset('web/images/bg-login.jpg') }}');background-repeat: no-repeat;background-size: contain;">
            <div class="container-fluid">
                <div class="absolute inset-0 z-0 "
                    style="background-image:url('{{ asset('web/images/job/curve-shape.png') }}')">
                </div>
            </div>
            <!--end container-->

            <div class="container z-1">
                <div class="grid grid-cols-1 mt-10">
                    <h4 class="lg:leading-normal leading-normal text-4xl lg:text-5xl mb-5 font-bold"
                        style="color: #1E2351;">Encuentra los mejores
                        <br>
                        Productos <span style="color: #0000F4;">y/o Servicios</span>
                    </h4>
                    <p class="text-slate-400 text-lg max-w-xl">
                        La brújula del empresario, la centralización de la cadena de suministro y el valor agregado.
                        Dónde puedes acortar los tiempos y maximizar tus costos, encuentra productos, servicios,
                        profesionistas especializados para proyectos..
                    </p>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="background-color: #0000F4; color: white;  text-align: center">
                            <h1 class="mb-0 text-success" style="font-size: 25px">
                                {{ session('success') }}
                            </h1>
                        </div>
                    @endif
                    <div class="grid lg:grid-cols-12 grid-cols-1" id="reserve-form">
                        <div class="lg:col-span-10 mt-8">
                            <div class="bg-white dark:bg-slate-900 border-0 shadow rounded p-3">
                                <!-- <form action="javascript:void(0)" method="GET"> -->
                                    <div class="registration-form text-dark text-start">
                                        <div class="grid " style="text-align: center; cursor:pointer;">
                                            <a href="{{ route('login') }}"
                                                title="Ir a panel administrativo"
                                                class="btn text-white searchbtn submit-btn w-100; cursor:pointer;"
                                                value="" style="height: 60px;background: #0000F4; line-height: 40px;">
                                                Bienvenido(a)
                                            </a>
                                        </div>
                                        <!--end grid-->
                                    </div>
                                    <!--end container-->
                                <!-- </form> -->
                            </div>
                        </div>
                        <!--ed col-->
                    </div>
                    <!--end grid-->

                </div>
            </div>
            <!--end container-->

            <div class="absolute inset-0 bg-indigo-600/5"></div>
            <ul class="circles p-0 mb-0">
                <li class="brand-img">
                    <img src="{{ asset('web/images/client/shree-logo.png') }}"
                        class="w-9 h-9" alt="">
                    </li>
                <li class="brand-img">
                    <img src="{{ asset('web/images/client/skype.png') }}"
                        class="w-9 h-9" alt="">
                </li>
                <li class="brand-img">
                    <img
                        src="{{ asset('web/images/client/snapchat.png') }}" class="w-9 h-9"
                        alt="">
                </li>
            </ul>
        </section>
        <!--end section-->
        <div class="relative">
            <div
                class="shape absolute right-0 sm:-bottom-px -bottom-[2px] left-0 overflow-hidden text-white dark:text-slate-900">
                <svg class="w-full h-auto" viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        <!-- End Hero -->

    </main>
    <!-- Main -->


    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top"
        class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 ltr:left-5 rtl:left-5 h-9 w-9 text-center bg-indigo-600 text-white leading-9"><i
            class="uil uil-arrow-up"></i></a>
    <!-- Back to top -->

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('web/libs/tiny-slider/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('web/libs/choices.js/public/assets/scripts/choices.min.j') }}s">
    </script>
    <script src="{{ asset('web/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('web/js/plugins.init.js') }}"></script>
    <script src="{{ asset('web/js/app.js') }}"></script>
    <!-- JAVASCRIPTS -->
</body>

</html>
