@extends('web.layouts.app')

@section('content')

<!-- Start Hero -->
<section class="md:h-screen py-30 h-auto relative flex items-center background-effect overflow-hidden"
    style="background-image: url('{{ asset('web/images/bg-login.jpg') }}');background-repeat: no-repeat;background-size: contain;">
    <div class="container-fluid">
        <div class="absolute inset-0 z-0 "
            style="background-image:url('{{ asset('web/images/job/curve-shape.png') }}')">
        </div>
    </div>
    <!--end container-->

    <div class="container z-1">
        <div class="grid grid-cols-1 mt-10">
            <h4 class="lg:leading-normal leading-normal text-4xl lg:text-5xl mb-5 font-bold" style="color: #1E2351;">
                Encuentra los mejores
                <br>
                Productos <span style="color: #0000F4;">y/o Servicios</span>
            </h4>
            <p class="text-slate-400 text-lg max-w-xl">
                La brújula del empresario, la centralización de la cadena de suministro y el valor agregado. Dónde
                puedes acortar los tiempos y maximizar tus costos, encuentra productos, servicios, profesionistas
                especializados para proyectos..
            </p>

            <div class="grid lg:grid-cols-12 grid-cols-1" id="reserve-form">
                <div class="lg:col-span-10 mt-8">
                    <div class="bg-white dark:bg-slate-900 border-0 shadow rounded p-3">

                        @if(Session::has('message'))
                            <hr />
                            <br />
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="background-color: #0000F4; color: white;  text-align: center">
                                <h1 class="mb-0 text-success" style="font-size: 25px">
                                    {{ Session::get('message') }}
                                </h1>
                            </div>
                            <br />
                            <hr />
                        @endif

                        <form action="javascript:void(0)" method="GET">
                            <div class="registration-form text-dark text-start">
                                <div class="grid " style="text-align: center; cursor:pointer;">
                                    <input type="submit" id="search" name="search" title="Ir a panel administrativo"
                                        class="btn text-white searchbtn submit-btn w-100; cursor:pointer;"
                                        value="Bienvenido(a). " style="height: 60px;background: #0000F4;">
                                </div>
                                <!--end grid-->
                            </div>
                            <!--end container-->
                        </form>
                    </div>
                </div>
                <!--ed col-->
            </div>
            <!--end grid-->

        </div>

        <!--end grid-->
    </div>
    <!--end container-->

    <div class="absolute inset-0 bg-indigo-600/5"></div>
    <ul class="circles p-0 mb-0">
        <li class="brand-img">
            <img src="{{ asset('web/images/client/shree-logo.png') }}" class="w-9 h-9" alt="">
        </li>
        <li class="brand-img">
            <img src="{{ asset('web/images/client/skype.png') }}" class="w-9 h-9" alt="">
        </li>
        <li class="brand-img">
            <img src="{{ asset('web/images/client/snapchat.png') }}" class="w-9 h-9" alt="">
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




<section class="relative">
    <div class="container">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">

            </h3>
        </div>
        <!--end grid-->
    </div>
</section>

@endsection
