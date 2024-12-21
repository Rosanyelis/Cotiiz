@extends('auth.layouts.app')
@section('title', 'Registrar '.$tipo)
@section('content')
    <div class="position-relative" style="background-image: url('{{ asset('web/images/bg-login.jpg') }}');background-repeat: no-repeat;background-size: cover;">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0" >
            <div class="authentication-inner py-6" style="max-width: 800px;">
                <!-- Login -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <img  src="{{ asset('assets/img/logo-cotiz.png') }}" width="25%" alt="logo" />
                    </div>
                    <!-- /Logo -->
                    @if ($tipo === 'empresa' && $registrado === 0)
                    @include('auth.partials.form-empresa-new')
                    @endif

                    @if ($tipo === 'empresa' && $registrado === 1)
                    @include('auth.partials.form-usuario-empresa')
                    @endif

                    @if ($tipo === 'Empresa-Prueba' && $registrado === 0)
                    @include('auth.partials.form-prueba-new')
                    @endif

                    @if ($tipo === 'proveedor' && $registrado === 0)
                    @include('auth.partials.form-proveedor-new')
                    @endif

                    @if ($tipo === 'proveedor' && $registrado === 1)
                    @include('auth.partials.form-usuario-proveedor')
                    @endif
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>

    @endsection
