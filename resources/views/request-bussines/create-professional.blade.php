@extends('layouts.app')
@section('title', 'Mis Solicitudes - Crear Solicitud de Profesionista')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header header-elements">
                <h5 class="mb-0 me-2">Crear Solicitud de Profesionista</h5>

                <div class="card-header-elements ms-auto">
                    <a href="{{ route('bussines-request.index') }}" class="btn btn-sm btn-secondary"
                    ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                </div>
            </div>

            <div class="card-body">
                <form id="formCategory" class="needs-validation" action="{{ route('bussines-request.storeProfessional') }}" method="POST">
                    @csrf
                    <div class="row gy-5">
                        <div class=" col-md-12">
                            <ul>
                                <li>Descargar documento necesario para solicitar productos, servicios o profesionistas:
                                    <a href="{{ asset('assets/Requisitos.pdf') }}" target="_blank">
                                        <i class="ri-file-pdf-2-fill ri-32px"></i>
                                    </a>
                                </li>
                                <li>Link para acceder a Drive de Cotiz:
                                    <a href="https://drive.google.com/drive/folders/1TDit6bm-o1TMFuQqQxLEO3ULKHk7gvHh?usp=sharing" target="_blank">
                                        <i class="ri-drive-fill ri-32px"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="type"
                                    name="type"
                                    class="form-control @if($errors->has('type')) is-invalid @endif"
                                    placeholder="Ingrese titulo de solicitud"
                                    value="{{ old('type') }}"
                                />
                                <label for="code">Titulo de Solicitud</label>
                                @if($errors->has('type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('type') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="activity_name"
                                    name="activity_name"
                                    class="form-control @if($errors->has('activity_name')) is-invalid @endif"
                                    placeholder="Ingrese Trabajo a realizar"
                                    value="{{ old('activity_name') }}"
                                />
                                <label for="code">Trabajo a realizar</label>
                                @if($errors->has('activity_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('activity_name') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="description"
                                    name="description"
                                    class="form-control @if($errors->has('description')) is-invalid @endif"
                                    placeholder="Ingrese Detalles del trabajo"
                                    value="{{ old('description') }}"
                                />
                                <label for="code">Detalles del trabajo</label>
                                @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="requirements"
                                    name="requirements"
                                    class="form-control @if($errors->has('requirements')) is-invalid @endif"
                                    placeholder="Ingrese Conocimientos deseados para el trabajo"
                                    value="{{ old('requirements') }}"
                                />
                                <label for="code">Conocimientos deseados para el trabajo</label>
                                @if($errors->has('requirements'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('requirements') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="certifications"
                                    name="certifications"
                                    class="form-control @if($errors->has('certifications')) is-invalid @endif"
                                    placeholder="Ingrese Certificaciones / cursos requeridos para este trabajo"
                                    value="{{ old('certifications') }}"
                                />
                                <label for="code">Certificaciones / cursos requeridos para este trabajo</label>
                                @if($errors->has('certifications'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('certifications') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="time"
                                    name="time"
                                    class="form-control @if($errors->has('time')) is-invalid @endif"
                                    placeholder="Ingrese Tiempo para implementar el trabajo"
                                    value="{{ old('time') }}"
                                />
                                <label for="code">Tiempo para implementar el trabajo</label>
                                @if($errors->has('time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('time') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <select name="urgency" id="urgency" id="urgency"
                                    class="form-select @if($errors->has('urgency')) is-invalid @endif">
                                    <option value="Normal">Normal</option>
                                    <option value="Urgente">Urgente</option>
                                </select>
                                <label for="code">Tipo de servicio</label>
                                @if($errors->has('urgency'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('urgency') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <textarea name="details_especialties"
                                class="form-control h-px-100 @if($errors->has('details_especialties')) is-invalid @endif"
                                id="details_especialties">{{ old('details_especialties') }}</textarea>
                                <label for="code">Datos especiales para realizar el trabajo</label>
                                @if($errors->has('details_especialties'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('details_especialties') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="link_drive"
                                    name="link_drive"
                                    class="form-control @if($errors->has('link_drive')) is-invalid @endif"
                                    placeholder="Ingrese titulo de solicitud"
                                    value="{{ old('link_drive') }}"
                                />
                                <label for="code">Link Drive</label>
                                @if($errors->has('link_drive'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link_drive') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class=" col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control @error('file') is-invalid @enderror" name="file" type="file" id="file">
                                <label for="code">Adjunta información importante</label>
                                @if($errors->has('file'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-4">
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
        <!--/ Ajax Sourced Server-side -->

    </div>
@endsection

