<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cottiz La brújula del empresario La centralización de la cadena de suministro y valor agregado.">
    <meta name="keywords" content="Startups, Kiibo Groups">
    <meta name="author" content="elemis">
    <title>Cotiz | WebSite</title>
    <!-- ========== Links ========== -->
    <link rel="stylesheet" href="{{ asset('web2/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('web2/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('web2/css/plugins/bootstrap.css') }}" />
    <link rel="shortcut icon" href="{{ asset('web/images/logo-cotiz.png') }}">
    <link rel="stylesheet" href="{{ asset('web2/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('web2/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web2/css/colors/aqua.css') }}">
    <link rel="preload" href="{{ asset('web2/css/fonts/thicccboi.css') }}" as="style" onload="this.rel='stylesheet'">
    <link href="{{ asset('profile/vendor/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('profile/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('profile/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <!-- CSS -->
    <style>
      .to-black{
          --tw-gradient-to: #161c2d !important;
      }
      .from-transparent {
          --tw-gradient-from: transparent !important;
          --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important;
      }
      .bg-gradient-to-b {
          background-image: -webkit-gradient(linear, left top, left bottom, from(var(--tw-gradient-stops))) !important;
          background-image: linear-gradient(to bottom, var(--tw-gradient-stops)) !important;
      }
      .inset-0 {
          top: 0px !important;
          right: 0px !important;
          bottom: 0px !important;
          left: 0px !important;
          }
      .absolute {
          position: absolute !important;
      }

      .password-icon {
        float: right;
        position: relative;
        margin: -25px 10px 0 0;
        cursor: pointer;
    }
    </style>
</head>
<body class="antialiased">
    <div class="content-wrapper" id="app">
        <!-- Nav -->

<header class="wrapper @if(Route::is('home')) bg-dark @else bg-soft-primary @endif">
    <nav class="navbar navbar-expand-lg d-none center-nav transparent @if(Route::is('home')) navbar-dark @elseif(Route::is('login') || Route::is('register'))  position-absolute @else navbar-light @endif">
      <div class="container flex-lg-row flex-nowrap align-items-center">
        <div class="navbar-brand w-100">
          <a href="{{url('./')}}">
            @if(Route::is('home'))
            <img src="{{ asset('assets2/images/logo-cotiz.png')}}" alt="" width="50px">
            @else
            <img src="{{ asset('assets2/images/logo-cotiz.png')}}" alt="" width="50px">
            @endif
          </a>
        </div>
        <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
          <div class="offcanvas-header d-lg-none">
            <h3 class="text-white fs-30 mb-0">Cotiz</h3>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
            <ul class="navbar-nav">

              <li class="nav-item dropdown dropdown-mega">
                <a class="nav-link" href="{{url('./')}}">Inicio</a>
              </li>
              <!-- /Inicio -->
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ url('./#about') }}">Sobre nosotros</a>
              </li>
              <!-- /About -->
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ url('./#events') }}">Eventos</a>
              </li>
              <!-- /Events -->
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ url('./#beneficts') }}">Beneficios</a>
              </li>
              <!-- /Beneficts -->
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ url('./call_advice')}}">Agenda una Llamada</a>
              </li>
              <!-- /Call -->
            </ul>
            <!-- /.navbar-nav -->
            <div class="offcanvas-footer d-lg-none">
              <div>
                <a href="mailto:{{$admin->shw_email}}" class="link-inverse">{{$admin->shw_email}}</a>
                <br /> {{$admin->phone_contact}} <br />
                <nav class="nav social social-white mt-4">
                  @if($admin->twitter)<a href="{{ $admin->twitter }}" target="_blank"><i class="uil uil-twitter"></i></a>@endif
                  @if($admin->fb)<a href="{{ $admin->fb }}" target="_blank"><i class="uil uil-facebook-f"></i></a> @endif
                  @if($admin->insta)<a href="{{ $admin->insta }}" target="_blank"><i class="uil uil-instagram"></i></a>@endif
                  @if($admin->youtube)<a href="{{ $admin->youtube }}" target="_blank"><i class="uil uil-youtube"></i></a>@endif
                </nav>
                <!-- /.social -->
              </div>
            </div>
            <!-- /.offcanvas-footer -->
          </div>
          <!-- /.offcanvas-body -->
        </div>
        <!-- /.navbar-collapse -->
        <div class="navbar-other w-100 d-flex ms-auto">
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('./contact') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contáctanos via email"><i class="uil uil-mailbox"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://wa.me/{{$admin->phone_contact}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Envianos un whatsapp"><i class="uil uil-whatsapp"></i></a>
            </li>

            @if(!Auth::user())
            <li class="nav-item d-none d-md-block">
              <a href="{{ route('login') }}" class="btn btn-sm btn-primary rounded">Ingresar</a>
            </li>
            @else
            <li class="nav-item  d-none d-md-block dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img src="{{ asset('profile/img/'.Auth::user()->pic_profile) }}" alt="Profile" class="rounded-circle" style="width: 30px;height: 30px;">
              </a>

              <ul class="dropdown-menu">
                <li class="nav-item">
                  <a class="dropdown-item" href="{{ route('home') }}">
                    Ir al perfil
                  </a>
                </li>
                <li class="dropdown dropdown-submenu dropend">
                  <a class="dropdown-item" href="{{ route('settings') }}">
                    Configuraciones
                  </a>
                </li>
                <li class="nav-item">
                  <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sessión
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
            @endif

            <li class="nav-item d-lg-none">
              <button class="hamburger offcanvas-nav-btn"><span></span></button>
            </li>
          </ul>
          <!-- /.navbar-nav -->
        </div>
        <!-- /.navbar-other -->
      </div>
      <!-- /.container -->
    </nav>
</header>

        <!-- /nav -->

        <!-- Main -->
        <main>
            @yield('content')
        </main>
        <!-- Main -->

    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
        @include("structure.footer")
    <!-- Footer -->

    <!-- JS -->
        @include("structure.footerjs")
    <!-- JS -->



    @yield('js')
</body>
</html>
