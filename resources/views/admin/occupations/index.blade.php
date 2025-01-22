@extends('layouts.app')
@section('title', 'Profesiones')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .custom-pagination .btn {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            font-size: 14px;
        }
    </style>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header header-elements border-bottom">
                <h5 class="mb-0 me-2">Profesiones</h5>

                <div class="card-header-elements ms-auto">
                    <a href="{{ route('occupation.viewimport') }}" class="btn btn-sm btn-success">
                        <i class="ri-file-excel-fill"></i> Importar Profesiones
                    </a>

                    <a href="{{ route('occupation.create') }}" class="btn btn-sm btn-primary">
                        <i class="ri-add-fill"></i> Crear Profesión
                    </a>
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
                <div class="card-footer border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="text-nowrap me-3">Mostrar</span>
                            <select id="page-length" class="form-select form-select-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="text-nowrap ms-3">registros</span>
                        </div>
        
                        <div class="custom-pagination">
                            <button id="go-to-first" class="btn btn-sm btn-light">
                                <i class="ri-arrow-left-s-line"></i>
                            </button>
                            <button id="go-to-last" class="btn btn-sm btn-light">
                                <i class="ri-arrow-right-s-line"></i>
                            </button>
                        </div>
                    </div>
            </div>            
            <!--/ Ajax Sourced Server-side -->

        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <!-- Page JS -->
        <script src="{{ asset('pagesjs/occupation.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Botón "Ir al Inicio"
                $('#go-to-first').on('click', function() {
                    $('.datatables-occupation').DataTable().page('first').draw('page');
                });

                // Botón "Ir al Final"
                $('#go-to-last').on('click', function() {
                    $('.datatables-occupation').DataTable().page('last').draw('page');
                });
            });
        </script>
    @endsection
