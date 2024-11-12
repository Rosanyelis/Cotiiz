@extends('auth.layouts.app')
@section('title', 'Tipo de Usuario')
@section('content')
    <div class="position-relative" style="background-image: url('{{ asset('web/images/bg-login.jpg') }}');background-repeat: no-repeat;background-size: cover;">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0" >
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <img  src="{{ asset('assets/img/logo-cotiz.png') }}" width="25%" alt="logo" />
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        <h4 class="mb-5 text-center">Regístrese en Cotiz</h4>
                        <div class="mb-5 row">
                            <div class="col-md-6 ">
                                <a href="{{ route('tipo.viewsearchRfc', 'empresa') }}" class="btn btn-primary d-grid w-100">
                                    Soy Empresa
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('tipo.viewsearchRfc', 'proveedor') }}" class="btn btn-primary d-grid w-100">
                                    Soy Proveedor
                                </a>
                            </div>
                        </div>
                        <p class="text-center">
                            <span>¿Posees una cuenta?</span>
                            <a href="{{ route('login') }}">
                                <span>Ingresar</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>

    @endsection
