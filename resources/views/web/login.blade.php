@extends('layouts.app_website')
@section('content')
<section class="md:h-screen py-36 flex items-center bg-no-repeat bg-center"
    style="background-image:url('{{ asset('web/images/bg-login.jpg') }}');background-size: contain;">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black"></div>
    <div class="container">
        <div class="flex justify-center">
            <div
                class="max-w-[400px] w-full m-auto p-6 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md">
                <img src="{{ asset('web/images/logo-cotiz.png') }}" width="200px" class="mx-auto"
                    alt="">
                <h5 class="my-6 text-xl font-semibold">Iniciar sesion</h5>
                <form class="ltr:text-left rtl:text-right" method="POST"
                    action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="loginEmail">Email</label>
                        <input id="email" type="email" class="form-input mt-3 @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="loginPassword">Contraseña</label>
                        <input id="password" type="password"
                            class="form-input mt-3 @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-info rounded-pill btn-login w-100 mb-2">
                        Ingresar
                    </button>
                </form>
                <!-- /form -->


                <p class="mb-0" style="color:black;">No tienes una cuenta?
                    <a href="{{ route('seccion_get') }}" class="hover"
                        style="color: #B46217">Registrate</a>
                </p>


            </div>
        </div>
    </div>
</section>
<!--end section -->



<div class="fixed bottom-3 ltr:right-3 rtl:left-3">
    <a href=""
        class="back-button btn btn-icon bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-full">
        <i data-feather="arrow-left" class="h-4 w-4"></i>
    </a>
</div>
<!-- /section -->
@endsection
