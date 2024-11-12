@extends('layouts.app')
@section('title', 'Productos - Crear')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Nuevo Productos</h5>

                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-secondary"><i
                            class="ri-arrow-left-line me-1"></i> Regresar</a>
                </div>
                <form class="needs-validation" action=" {{ route('product.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-6">
                            <img src="{{asset('assets/img/products/no-photo.jpg')}}" alt="user-avatar"
                                class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Cargar imagen de Producto</span>
                                    <i class="ri-upload-2-line d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input @if($errors->has('photo')) is-invalid @endif" hidden
                                        accept="image/png, image/jpeg" name="photo" />
                                </label>
                                <button type="button" class="btn btn-outline-danger account-image-reset mb-4">
                                    <i class="ri-refresh-line d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <div>JPG, GIF o PNG permitidos. Tamaño máximo de 800K</div>
                            </div>
                            @if($errors->has('photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="name"
                                        class="form-control @if($errors->has('name')) is-invalid @endif"
                                        placeholder="Ingrese nombre de producto"
                                        value="{{ old('name') }}" />
                                    <label for="code">Producto</label>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="price" name="price"
                                        class="form-control @if($errors->has('price')) is-invalid @endif"
                                        placeholder="Ingrese precio de venta de producto"
                                        value="{{ old('price') }}" />
                                    <label for="code">Precio de venta</label>
                                    @if($errors->has('price'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="description" name="description"
                                        class="form-control @if($errors->has('description')) is-invalid @endif"
                                        placeholder="Ingrese descripcion de producto"
                                        value="{{ old('description') }}" />
                                    <label for="code">Descripción</label>
                                    @if($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="mb-6 col-md-1">
                                <button type="submit" class="btn btn-primary float-end">
                                    <i class="ri-save-2-line me-1"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Page JS -->
<script>
    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
</script>
<script src="{{ asset('pagesjs/product.js') }}"></script>
@endsection
