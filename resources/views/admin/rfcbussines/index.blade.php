@extends('layouts.app')
@section('title', 'Empresas')
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
            <h5 class="mb-0 me-2">Empresas</h5>
        </div>

        <div class="card-datatable text-nowrap">
            <table class="datatables-bussines table table-sm">
                <thead>
                    <tr>
                        <th>RFC</th>
                        <th>Nombre</th>
                        <th>Calle</th>
                        <th>N° Calle</th>
                        <th>Colonia</th>
                        <th>CashBack</th>
                        <th>Estatus</th>
                        <th style="width: 10px"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Ajax Sourced Server-side -->
    @include('admin.rfcbussines.partials.modal-cashback')
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/bussines.js') }}"></script>
@endsection
