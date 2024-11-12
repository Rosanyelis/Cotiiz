@extends('layouts.app')
@section('title', 'Especialidades - Editar')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Especialidades</h5>

                        <a href="{{ route('specialty.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation" action="{{ route('specialty.update', $specialty->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control @if($errors->has('name')) is-invalid @endif"
                                            placeholder="Ingrese nombre de especialidad"
                                            value="{{ $specialty->name }}"
                                        />
                                        <label for="code">Nombre de especialidad</label>
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary float-end">
                                        <i class="ri-save-2-line me-1"></i>
                                        Actualizar
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
