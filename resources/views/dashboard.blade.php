@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <!-- Ventas del mes -->
        <div class="col-md-12 col-xxl-8">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-md-6 order-2 order-md-1">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Bienvenido ! <span class="fw-bold">{{ Auth::user()->name }}!</span> 🎉</h4>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                        <div class="card-body pb-0 px-0 pt-2">
                        <img src="../../assets/img/illustrations/illustration-john-light.png"
                            height="186" class="scaleX-n1-rtl" alt="View Profile"
                            data-app-light-img="illustrations/illustration-john-light.png"
                            data-app-dark-img="illustrations/illustration-john-dark.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ventas del mes -->
        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between flex-wrap gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-success rounded">
                                <i class="ri-money-dollar-circle-fill ri-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0" id="empresas">0</h5>
                            <p class="mb-0">Empresas</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-info rounded">
                                <i class="ri-money-dollar-circle-fill ri-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0" id="proveedores">0</h5>
                            <p class="mb-0">Proveedores</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-warning rounded">
                                <i class="ri-money-dollar-circle-fill ri-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0" id="solicitudes">0</h5>
                            <p class="mb-0">Solicitudes</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-info rounded">
                                <i class="ri-money-dollar-circle-fill ri-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0" id="catalogos">0</h5>
                            <p class="mb-0">Catalogos</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
