@extends('layouts.app')
@section('title', 'Solicitudes de Proveedor - Crear')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Nueva Solicitud a Proveedor</h5>

                        <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>

                    <div class="card-body">
                        <form id="formRequestSupplier" class="needs-validation" action="{{ route('request-supplier.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <!-- Buscador de Proveedores -->
                                    <div class="mb-3 col-md-6">
                                        <label for="supplier-search" class="form-label">Buscar Proveedor</label>
                                        <input
                                            type="text"
                                            id="supplier-search"
                                            class="form-control"
                                            placeholder="Escribe para buscar..."
                                        />
                                    </div>
                                
                                    <!-- Selector de Proveedores -->
                                    <div class="mb-3 col-md-6">
                                        <label for="rfc_suppliers_id" class="form-label">Proveedor</label>
                                        <select
                                            id="rfc_suppliers_id"
                                            name="rfc_suppliers_id"
                                            class="form-select select2 @if($errors->has('rfc_suppliers_id')) is-invalid @endif"
                                        >
                                            <option value="">-- Seleccionar --</option>
                                            @foreach ($rfcSuppliers as $item)
                                                <option value="{{ $item->id }}" {{ old('rfc_suppliers_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('rfc_suppliers_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('rfc_suppliers_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-6 col-md-12">
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
                                <div class="mb-6 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control @if($errors->has('file')) is-invalid @endif" type="file" name="file" id="file">
                                        <label for="code">Archivo de solicitud (opcional)</label>
                                        @if($errors->has('file'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100 "
                                        id="observation" placeholder="Descripción de solicitud"
                                        name="observation">{{ old('observation') }}</textarea>
                                        <label for="code">Descripción de solicitud (opcional)</label>
                                        @if($errors->has('observation'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('observation') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-6 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100 @if($errors->has('message')) is-invalid @endif "
                                        id="message"
                                        placeholder="Mensaje de solicitud" name="message">{{ old('message') }}</textarea>
                                        <label for="code">Mensaje al proveedor</label>
                                        @if($errors->has('message'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('message') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary float-end"
                                        id="saveRequest">
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
@section('scripts')
    <script src="{{ asset('pagesjs/supplier-request.js') }}"></script>
@endsection
