@extends('layouts.app')
@section('title', 'Profesionales - Ver')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ver Profesional</h5>

                    <a href="{{ route('admin.professional.index') }}" class="btn btn-sm btn-secondary"><i
                            class="ri-arrow-left-line me-1"></i> Regresar</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-flex justify-content-center">
                                @if($data->photo == null)
                                    <img src="{{ asset('assets/img/products/no-photo.jpg') }}"
                                        alt="user-avatar" class="d-block w-px-200 h-px-200 rounded-4"
                                        id="uploadedAvatar" />
                                @else
                                    <img src="{{ asset($data->file_photo) }}" alt="user-avatar"
                                        class="d-block w-px-200 h-px-200 rounded-4" id="uploadedAvatar" />
                                @endif
                            </div>
                            <ul class="list-unstyled my-3 py-1">
                                <li class="d-flex align-items-center mb-4">
                                    <span class="fw-bold mx-2">Estatus:</span>
                                    <span>{{ $data->status }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <!-- <div class="d-flex d-flex align-items-start"> -->
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Empresa:</span>
                                        <span>{{ $data->rfcsupplier->name }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Usuario:</span>
                                        <span>{{ $data->user->name }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Primer Nombre:</span>
                                        <span>{{ $data->firstname }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Segundo Nombre:</span>
                                        <span>{{ $data->second_name }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Primer Apellido:</span>
                                        <span>{{ $data->lastname }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Segundo Apellido:</span>
                                        <span>{{ $data->second_lastname }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Profesión:</span>
                                        <span>{{ $data->occupation->name }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Especialidad:</span>
                                        <span>{{ $data->specialty->name }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Teléfono:</span>
                                        <span>{{ $data->phone }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Correo:</span>
                                        <span>{{ $data->email }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">País:</span>
                                        <span>{{ $data->country }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Estado:</span>
                                        <span>{{ $data->state }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Ciudad:</span>
                                        <span>{{ $data->city }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Dirección:</span>
                                        <span>{{ $data->address }}</span>
                                    </li>
                                </ul>
                            <!-- </div> -->
                        </div>
                        <div class="col-md-4">
                            <!-- <div class="d-flex d-flex align-items-start"> -->
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Codigo Postal:</span>
                                        <span>{{ $data->zip }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Facebook:</span>
                                        <span>{{ $data->facebook }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Twitter:</span>
                                        <span>{{ $data->twitter }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Instagram:</span>
                                        <span>{{ $data->instagram }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Linkedin:</span>
                                        <span>{{ $data->linkedin }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Hoja de Vida o CV:</span>
                                        <a class="mx-2" href="{{ asset($data->file_cv) }}" target="_blank" >Descargar</a>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Titulo o Carta pasante a color lado #1:</span>
                                        <a class="mx-2" href="{{ asset($data->file_title_trainee_1) }}" target="_blank" >Descargar</a>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Titulo o Carta pasante a color lado #2:</span>
                                        <a class="mx-2" href="{{ asset($data->file_title_trainee_2) }}" target="_blank" >Descargar</a>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Foto credencial de elector (INE) lado #1:</span>
                                        <a class="mx-2" href="{{ asset($data->file_voter_idcard_1) }}" target="_blank" >Descargar</a>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Foto credencial de elector (INE) lado #2:</span>
                                        <a class="mx-2" href="{{ asset($data->file_voter_idcard_2) }}" target="_blank" >Descargar</a>
                                    </li>

                                </ul>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
