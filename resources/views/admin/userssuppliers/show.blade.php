@extends('layouts.app')
@section('title', 'Usuario de Empresa - Ver')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card mb-6">
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-4 mt-sm-12">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                            <div class="user-profile-info">
                                <h2>{{ $data->name }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar pills -->
    <div class="row">
        <div class="col-md-12">
            <div class="nav-align-top">
                <ul class="nav nav-pills mb-4" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                            aria-selected="true">
                            <i class="ri-user-3-line me-2"></i>
                            Información
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Nombre de Usuario:</span>
                                    <span class="mx-2">{{ $data->name }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Correo:</span>
                                    <span class="mx-2">{{ $data->email }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Primer Nombre:</span>
                                    <span class="mx-2">{{ $data->firstname }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Segundo Nombre:</span>
                                    <span class="mx-2">{{ $data->second_name }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Apellido Paterno:</span>
                                    <span class="mx-2">{{ $data->lastname }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Apellido Materno:</span>
                                    <span class="mx-2">{{ $data->second_lastname }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Teléfono:</span>
                                    <span class="mx-2">{{ $data->phone }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Puesto que desempeña en la empresa:</span>
                                    <span class="mx-2">{{ $data->workstation }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Área en la que se encuentra:</span>
                                    <span class="mx-2">{{ $data->area_work }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Foto de gafete lado #1:</span>
                                    <a class="mx-2" href="{{ asset($data->file_gafete) }}" target="_blank" >Descargar</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Foto de gafete lado #2:</span>
                                    <a class="mx-2" href="{{ asset($data->file_gafete2) }}" target="_blank" >Descargar</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Foto credencial de elector (INE) lado #1:</span>
                                    <a class="mx-2" href="{{ asset($data->file_credential) }}" target="_blank" >Descargar</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Foto credencial de elector (INE) lado #2:</span>
                                    <a class="mx-2" href="{{ asset($data->file_credential2) }}" target="_blank" >Descargar</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">País:</span>
                                    <span class="mx-2">{{ $data->country }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Estado:</span>
                                    <span class="mx-2">{{ $data->state }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Municipio:</span>
                                    <span class="mx-2">{{ $data->municipality }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Colonia:</span>
                                    <span class="mx-2">{{ $data->colony }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Calle:</span>
                                    <span class="mx-2">{{ $data->street }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Numero de Calle:</span>
                                    <span class="mx-2">{{ $data->street_number }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-4">
                                    <span class="fw-bold mx-2 mb-2">Codigo Postal:</span>
                                    <span class="mx-2">{{ $data->postal_code }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--/ Navbar pills -->
</div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('pagesjs/bussines-users.js') }}"></script>
@endsection