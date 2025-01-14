@extends('layouts.app')
@section('title', 'Empresas - Usuarios - Editar')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Editar Usuario <strong>{{ $user->name }}</strong> de Empresa <strong>{{ $data->name }}</strong></h5>

                        <a href="{{ route('supplier.show', $rfc) }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation"
                            action="{{ route('supplier.users.update_users',
                                    ['cliente' => $data->id, 'user' => $user->id]) }}"
                            method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <h6>1. Información de Empleado</h6>

                                <div class="mb-6 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="firstname"
                                            name="firstname"
                                            class="form-control @if($errors->has('firstname')) is-invalid @endif"
                                            placeholder="Ingrese Primer Nombre"
                                            value="{{ old('firstname', $user->firstname) }}"
                                        />
                                        <label for="code">Primer Nombre</label>
                                        @if($errors->has('firstname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('firstname') }}
                                        </div>
                                        @endif
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
                                        @if($errors->has('second_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_name') }}
                                        </div>
                                        @endif
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
                                        @if($errors->has('lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('lastname') }}
                                        </div>
                                        @endif
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
                                        @if($errors->has('second_lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_lastname') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="file"
                                        class="form-control @if($errors->has('file_gafete')) is-invalid @endif"
                                        id="file_gafete" name="file_gafete"  />
                                        <label for="file_gafete">Foto de gafete lado #1</label>
                                        @if($errors->has('file_gafete'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file_gafete') }}
                                            </div>
                                        @endif
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
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="file"
                                        class="form-control @if($errors->has('file_gafete2')) is-invalid @endif"
                                        id="file_gafete2" name="file_gafete2"  />
                                        <label for="file_gafete2">Foto de gafete lado #2</label>
                                        @if($errors->has('file_gafete2'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file_gafete2') }}
                                            </div>
                                        @endif
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
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="file"
                                        class="form-control @if($errors->has('file_credential')) is-invalid @endif"
                                        id="file_credential" name="file_credential"  />
                                        <label for="file_credential">Foto credencial de elector (INE) lado #1</label>
                                        @if($errors->has('file_credential'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file_credential') }}
                                            </div>
                                        @endif
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
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="file"
                                        class="form-control @if($errors->has('file_credential2')) is-invalid @endif"
                                        id="file_credential2" name="file_credential2"  />
                                        <label for="file_credential2">Foto credencial de elector (INE) lado #2</label>
                                        @if($errors->has('file_credential2'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file_credential2') }}
                                            </div>
                                        @endif
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
                                        id="workstation" name="workstation"  value="{{ old('workstation', $user->workstation) }}" />
                                        <label for="workstation">Puesto que desempeña en la empresa </label>
                                        @if($errors->has('workstation'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('workstation') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('area_work')) is-invalid @endif"
                                        id="area_work" name="area_work"  value="{{ old('area_work', $user->area_work) }}" />
                                        <label for="area_work">Área en la que se encuentra </label>
                                        @if($errors->has('area_work'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('area_work') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="phone_work"
                                        name="phone_work"
                                        value="{{ old('phone_work', $data->phone) }}"
                                        disabled />
                                        <label for="phone_work">Teléfono de la empresa / extensión </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('phone')) is-invalid @endif"
                                        id="phone" name="phone"
                                        value="{{ old('phone', $user->phone) }}" />
                                        <label for="phone">Teléfono personal </label>
                                        @if($errors->has('phone'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('phone') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-6 mx-n4">
                                <h6>2. Información de Direccion Personal</h6>
                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('country')) is-invalid @endif"
                                        id="country" name="country" value="{{ old('country', $user->country) }}"/>
                                        <label for="country">País</label>
                                        @if($errors->has('country'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('country') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('state')) is-invalid @endif"
                                        id="state" name="state"  value="{{ old('state', $user->state) }}"  />
                                        <label for="state">Estado</label>
                                        @if($errors->has('state'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('state') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('municipality')) is-invalid @endif"
                                        id="municipality" name="municipality"
                                        value="{{ old('municipality', $user->municipality) }}"  />
                                        <label for="municipality">Municipio</label>
                                        @if($errors->has('municipality'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('municipality') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('colony')) is-invalid @endif"
                                        id="colony" name="colony"
                                        value="{{ old('colony', $user->colony) }}"  />
                                        <label for="colony">Colonia</label>
                                        @if($errors->has('colony'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('colony') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('street')) is-invalid @endif"
                                        id="street" name="street"
                                        value="{{ old('street', $user->street) }}" />
                                        <label for="street">Calle</label>
                                        @if($errors->has('street'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('street') }}
                                            </div>
                                        @endif
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
                                        />
                                        <label for="code">Usuario</label>
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                        @endif
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
                                        />
                                        <label for="code">Correo</label>
                                        @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            class="form-control @if($errors->has('password')) is-invalid @endif"
                                            placeholder="********"
                                            value="{{ old('password') }}"
                                        />
                                        <label for="code">Contraseña</label>
                                        @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary float-end">
                                        <i class="ri-save-2-line me-1"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
