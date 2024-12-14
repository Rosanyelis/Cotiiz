@extends('layouts.app')
@section('title', 'Profesiones')
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
            <h5 class="mb-0 me-2">Profesiones</h5>

            <div class="card-header-elements ms-auto">
                <a href="{{ route('occupation.viewimport') }}" class="btn btn-sm btn-success"
                ><i class="ri-file-excel-fill"></i> Importar Profesiones</a>

                <a href="{{ route('occupation.create') }}" class="btn btn-sm btn-primary"
                ><i class="ri-add-fill"></i> Crear Profesión</a>
            </div>
        </div>

        <div class="card-datatable text-nowrap">
            <table class="datatables-occupation table table-sm">
                <thead>
                    <tr>
                        <th>Profesiones</th>
                        <th style="width: 10px"></th>
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
    <script src="{{ asset('pagesjs/occupation.js') }}"></script>
@endsection
