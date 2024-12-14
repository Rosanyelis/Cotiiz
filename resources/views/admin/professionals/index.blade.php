@extends('layouts.app')
@section('title', 'Catálogo - Profesionales')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Ajax Sourced Server-side -->
    <div class="card">
        <div class="card-header header-elements border-bottom">
            <h5 class="mb-0">Profesionales</h5>

            <div class="card-header-elements ms-auto">

            </div>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="datatables-admin-profesional table table-sm">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Usuario</th>
                        <th>Foto</th>
                        <th>Profesional</th>
                        <th>Profesión</th>
                        <th>Especialidad</th>
                        <th>Estatus</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Ajax Sourced Server-side -->

</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/admin-professional.js') }}"></script>
@endsection
