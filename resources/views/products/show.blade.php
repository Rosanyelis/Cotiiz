@extends('layouts.app')
@section('title', 'Productos - Ver')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ver Productos</h5>

                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-secondary"><i
                            class="ri-arrow-left-line me-1"></i> Regresar</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-flex align-items-start align-items-sm-center gap-6">
                                @if($data->photo == null)
                                    <img src="{{ asset('assets/img/products/no-photo.jpg') }}"
                                        alt="user-avatar" class="d-block w-px-200 h-px-200 rounded-4"
                                        id="uploadedAvatar" />
                                @else
                                    <img src="{{ asset($data->photo) }}" alt="user-avatar"
                                        class="d-block w-px-200 h-px-200 rounded-4" id="uploadedAvatar" />
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex d-flex align-items-start">
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Producto:</span>
                                        <span>{{ $data->name }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Precio:</span>
                                        <span>{{ $data->price }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                        <span class="fw-bold mx-2">Descripción:</span>
                                        <span>{{ $data->description }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
