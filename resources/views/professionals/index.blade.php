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
                <a href="{{ route('professional.create') }}" class="btn btn-sm btn-primary"
                >Crear Profesional</a>
            </div>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="datatables-product table table-sm">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Profesional</th>
                        <th>Profesión</th>
                        <th>Especialidad</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
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
    <script src="{{ asset('pagesjs/professionals.js') }}"></script>
@endsection
