<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cotiz descubre nuestros mejores eventos y agenda una llamada con nuestros mejores mentores.">
    <meta name="keywords" content="Mentorias, Eventos, Inversiones, Startups, DQV, Kiibo Groups">
    <meta name="author" content="Kiibo Groups">
    <meta name="website" content="https://kiibo.mx" />
    <meta name="email" content="soporte@kiibo.mx" />
    <title>Cotiz | WebSite</title>
    <meta name="version" content="1.6.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <!-- Css -->
    <link href="{{ asset('web/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('web/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('web/css/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('web/css/tailwind.css') }}" rel="stylesheet" />
</head>

<body class="font-nunito text-base text-black dark:text-white dark:bg-slate-900">

    <nav id="topnav" class="defaultscroll is-sticky bg-white dark:bg-slate-900">
        <div class="container">
            <!-- Logo container-->
            <a class="logo ltr:pl-0 rtl:pr-0" href="javascript:void(0)">
                <img src="{{ asset('web/images/logo-cotiz.png') }}" style="width: 150px;"
                    class="inline-block dark:hidden" alt="">
                <img src="{{ asset('web/images/logo-cotiz.png') }}" style="width: 150px;"
                    class="hidden dark:inline-block" alt="">
            </a>

            <!--Login button Start-->
            <ul class="buy-button list-none mb-0">
                <li class="inline mb-0">
                    <a href="{{ route('login') }}" class="btn btn-icon rounded-full hover:text-black">
                        <i data-feather="user" class="h-4 w-4"></i>
                    </a>
                </li>

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
        @yield('content')
    </main>
    <!-- Main -->


    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fixed hidden text-lg
        rounded-full z-10 bottom-5 ltr:left-5 rtl:left-5 h-9 w-9 text-center
        bg-indigo-600 text-white leading-9">
        <i class="uil uil-arrow-up"></i>
    </a>
    <!-- Back to top -->

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('web/libs/tiny-slider/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('web/libs/choices.js/public/assets/scripts/choices.min.j') }}s"></script>
    <script src="{{ asset('web/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('web/js/plugins.init.js') }}"></script>
    <script src="{{ asset('web/js/app.js') }}"></script>
    <!-- JAVASCRIPTS -->
</body>

</html>
