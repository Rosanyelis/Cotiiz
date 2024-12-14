@extends('layouts.app')
@section('title', 'Profesiones - Importar Profesiones')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Profesiones</h5>

                        <a href="{{ route('occupation.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation" action="{{ route('occupation.import') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-muted">Importar Profesiones, se adjunta un formato de ejemplo de un excel. Por favor, cumplir con el formato <br>
                                        <a href="{{ asset('samples-imports/samples-profesiones.xlsx') }}" target="_blank" download>Descargar Plantilla</a></p>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="file" name="archivo">
                                        <label for="code">Adjuntar archivo</label>
                                        @if($errors->has('archivo'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('archivo') }}
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
