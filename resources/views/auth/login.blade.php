@extends('auth.layouts.app')
@section('title', 'Iniciar Sesión')
@section('content')
    <div class="position-relative" style="background-image: url('{{ asset('web/images/bg-login.jpg') }}');background-repeat: no-repeat;background-size: cover;">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0" >
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <img  src="{{ asset('assets/img/logo-cotiz.png') }}" width="40%" alt="logo" />
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        <h4 class="mb-5 text-center">Bienvenido! 👋</h4>

                        <form id="formAuthentication" class="mb-5" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating form-floating-outline mb-5">
                                <input
                                    type="text"
                                    class="form-control @if($errors->has('email')) is-invalid @endif"
                                    id="email"
                                    name="email"
                                    placeholder="Ingrese el correo"
                                    autofocus />
                                <label for="email">Correo</label>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-5">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                            type="password"
                                            class="form-control @if($errors->has('password')) is-invalid @endif"
                                            name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                            <label for="password">Contraseña</label>
                                            @if($errors->has('password'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5 d-flex justify-content-between mt-5">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Recuerdame </label>
                                </div>
                                <a href="auth-forgot-password-basic.html" class="float-end mb-1 mt-2">
                                    <span>¿Olvidate tu contraseña?</span>
                                </a>
                            </div>
                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" type="submit">Ingresar</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>¿Eres nuevo en la plataforma?</span>
                            <a href="{{ route('tipo.register') }}">
                                <span>Registrarme</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
                <!-- <img
                    alt="mask"
                    src="{{ asset('web/images/bg-login.png') }}"
                    class="authentication-image"
                    data-app-light-img="illustrations/auth-basic-login-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" /> -->
            </div>
        </div>
    </div>
@endsection
