@extends('layouts.app')
@section('title', 'Mis Solicitudes - Crear Solicitud de Producto')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Ajax Sourced Server-side -->
        <div class="card">
            <div class="card-header header-elements">
                <h5 class="mb-0 me-2">Crear Solicitud de Producto</h5>

                <div class="card-header-elements ms-auto">
                    <a href="{{ route('bussines-request.index') }}" class="btn btn-sm btn-secondary"
                    ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                </div>
            </div>

            <div class="card-body">
                <form id="formCategory" class="needs-validation" action="{{ route('bussines-request.storeProduct') }}" method="POST" enctype="multipart/form-data">
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
                                    id="product_name"
                                    name="product_name"
                                    class="form-control @if($errors->has('product_name')) is-invalid @endif"
                                    placeholder="Ingrese nombre de producto"
                                    value="{{ old('product_name') }}"
                                />
                                <label for="code">Nombre del producto / dispositivo</label>
                                @if($errors->has('product_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_name') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="model"
                                    name="model"
                                    class="form-control @if($errors->has('model')) is-invalid @endif"
                                    placeholder="Ingrese modelo de producto"
                                    value="{{ old('model') }}"
                                />
                                <label for="code">Modelo</label>
                                @if($errors->has('model'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('model') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="brand"
                                    name="brand"
                                    class="form-control @if($errors->has('brand')) is-invalid @endif"
                                    placeholder="Ingrese Marca de producto"
                                    value="{{ old('brand') }}"
                                />
                                <label for="code">Marca</label>
                                @if($errors->has('brand'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('brand') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="quantity"
                                    name="quantity"
                                    class="form-control @if($errors->has('quantity')) is-invalid @endif"
                                    placeholder="Ingrese Cantidad de producto"
                                    value="{{ old('quantity') }}"
                                />
                                <label for="code">Cantidad</label>
                                @if($errors->has('quantity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('quantity') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="budget"
                                    name="budget"
                                    class="form-control @if($errors->has('budget')) is-invalid @endif"
                                    placeholder="Ingrese Presupuesto de producto"
                                    value="{{ old('budget') }}"
                                />
                                <label for="code">Presupuesto aproximado para invertir</label>
                                @if($errors->has('budget'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('budget') }}
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
                                <textarea name="description"
                                class="form-control h-px-100 @if($errors->has('description')) is-invalid @endif"
                                id="description">{{ old('description') }}</textarea>
                                <label for="code">Description</label>
                                @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
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
                                <label for="file">Adjunta información importante</label>
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

