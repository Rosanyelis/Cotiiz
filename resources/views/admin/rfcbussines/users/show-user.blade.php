@extends('layouts.app')
@section('title', 'Usuarios - Ver')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Usuario <strong>{{ $user->name }}</strong>  de la empresa <strong>{{ $data->name }}</strong></h5>

                        <a href="{{ route('business.show', $data->id) }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation" action="{{ route('business.store_user_bussines') }}"
                        encType="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                            <h6>1. Información de Empleado</h6>

                                <div class="mb-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="firstname"
                                            name="firstname"
                                            class="form-control @if($errors->has('firstname')) is-invalid @endif"
                                            value="{{ old('firstname', $user->firstname) }}"
                                            readonly
                                        />
                                        <label for="code">Primer Nombre</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="second_name"
                                            name="second_name"
                                            class="form-control @if($errors->has('second_name')) is-invalid @endif"
                                            placeholder="Ingrese Segundo Nombre"
                                            value="{{ old('second_name', $user->second_name) }}"
                                        />
                                        <label for="code">Segundo Nombre</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="lastname"
                                            name="lastname"
                                            class="form-control @if($errors->has('lastname')) is-invalid @endif"
                                            placeholder="Ingrese Primer Nombre"
                                            value="{{ old('lastname', $user->lastname) }}"
                                        />
                                        <label for="code">Apellido paterno</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="second_lastname"
                                            name="second_lastname"
                                            class="form-control @if($errors->has('second_lastname')) is-invalid @endif"
                                            placeholder="Ingrese Segundo Nombre"
                                            value="{{ old('second_lastname', $user->second_lastname) }}"
                                        />
                                        <label for="code">Apellido Materno</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-4">
                                        <span class="fw-bold mx-2 mb-2">Foto de gafete lado #1</span>
                                        @if ($user->file_gafete != null)
                                        <span class="mx-2">
                                            <a href="{{ asset($user->file_gafete) }}" target="_blank" >Ver Archivo</a>
                                        </span>
                                        @else
                                        <span class="mx-2">No tiene archivo</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-4">
                                        <span class="fw-bold mx-2 mb-2">Foto de gafete lado #2</span>
                                        @if ($user->file_gafete2 != null)
                                        <span class="mx-2">
                                            <a href="{{ asset($user->file_gafete2) }}" target="_blank" >Ver Archivo</a>
                                        </span>
                                        @else
                                        <span class="mx-2">No tiene archivo</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-4">
                                        <span class="fw-bold mx-2 mb-2">Foto credencial de elector (INE) lado #1</span>
                                        @if ($user->file_credential != null)
                                        <span class="mx-2">
                                            <a href="{{ asset($user->file_credential) }}" target="_blank" >Ver Archivo</a>
                                        </span>
                                        @else
                                        <span class="mx-2">No tiene archivo</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-4">
                                        <span class="fw-bold mx-2 mb-2">Foto credencial de elector (INE) lado #2</span>
                                        @if ($user->file_credential2 != null)
                                        <span class="mx-2">
                                            <a href="{{ asset($user->file_credential2) }}" target="_blank" >Ver Archivo</a>
                                        </span>
                                        @else
                                        <span class="mx-2">No tiene archivo</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('workstation')) is-invalid @endif"
                                        id="workstation"
                                        name="workstation"
                                        value="{{ old('workstation', $user->workstation) }}"
                                        readonly />
                                        <label for="workstation">Puesto que desempeña en la empresa </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('area_work')) is-invalid @endif"
                                        id="area_work" name="area_work"
                                        value="{{ old('area_work', $user->area_work) }}"
                                        readonly />
                                        <label for="area_work">Área en la que se encuentra </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('phone')) is-invalid @endif"
                                        id="phone" name="phone"
                                        value="{{ old('phone', $data->phone) }}"
                                        readonly />
                                        <label for="phone">Teléfono de la empresa / extensión </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('phone_personal')) is-invalid @endif"
                                        id="phone_personal" name="phone_personal"
                                        value="{{ old('phone_personal', $user->phone) }}"
                                        readonly />
                                        <label for="phone_personal">Teléfono personal </label>
                                    </div>
                                </div>
                                <hr class="my-6 mx-n4">
                                <h6>2. Información de Direccion Personal</h6>
                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('country')) is-invalid @endif"
                                        id="country" name="country"
                                        value="{{ old('country', $user->country) }}"
                                        readonly/>
                                        <label for="country">País</label>  
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('state')) is-invalid @endif"
                                        id="state" name="state"
                                        value="{{ old('state', $user->state) }}"
                                        readonly  />
                                        <label for="state">Estado</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('municipality')) is-invalid @endif"
                                        id="municipality" name="municipality"
                                        value="{{ old('municipality', $user->municipality) }}"
                                        readonly/>
                                        <label for="municipality">Municipio</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('colony')) is-invalid @endif"
                                        id="colony" name="colony"
                                        value="{{ old('colony', $user->colony) }}"
                                        readonly />
                                        <label for="colony">Colonia</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('street')) is-invalid @endif"
                                        id="street" name="street"
                                        value="{{ old('street', $user->street) }}"
                                        readonly/>
                                        <label for="street">Calle</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('street_number')) is-invalid @endif"
                                        id="street_number" name="street_number"
                                        value="{{ old('street_number', $user->street_number) }}"
                                        readonly/>
                                        <label for="street_number">Numero de Calle</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('postal_code')) is-invalid @endif"
                                        id="postal_code" name="postal_code"
                                        value="{{ old('postal_code', $user->postal_code) }}"
                                        readonly />
                                        <label for="postal_code">Codigo Postal</label>
                                    </div>
                                </div>

                                <hr class="my-6 mx-n4">
                                <h6>3. Información de Usuario</h6>
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control @if($errors->has('name')) is-invalid @endif"
                                            placeholder="Ingrese nombre de usuario"
                                            value="{{ old('name', $user->name) }}"
                                            readonly
                                        />
                                        <label for="code">Usuario</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="form-control @if($errors->has('email')) is-invalid @endif"
                                            placeholder="Ingrese Correo"
                                            value="{{ old('email', $user->email) }}"
                                            readonly
                                        />
                                        <label for="code">Correo</label>
                                    </div>
                                </div>
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="password"
                                            name="password"
                                            class="form-control @if($errors->has('password')) is-invalid @endif"
                                            placeholder="********"
                                            value="{{ old('password', $user->passwordshow) }}"
                                        />
                                        <label for="code">Contraseña</label>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
