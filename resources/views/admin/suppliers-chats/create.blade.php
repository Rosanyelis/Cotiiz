@extends('layouts.app')
@section('title', 'Buzón de Proveedores - Crear')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Nuevo Buzón de Proveedores</h5>

                    <a href="{{ route('admin.supplier-chat.index') }}" class="btn btn-sm btn-secondary"><i
                            class="ri-arrow-left-line me-1"></i> Regresar</a>
                </div>
                <form class="needs-validation" action=" {{ route('product.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="mb-6 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select name="rfc_suppliers_id" id="rfc_suppliers_id" class="form-select">
                                        <option value="">Seleccione un proveedor</option>
                                        @foreach ($rfcs as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="code">Proveedor</label>
                                    @if($errors->has('rfc_suppliers_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('rfc_suppliers_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="file" id="formFile" name="file">
                                    <label for="code">Archivo de mensaje</label>
                                    @if($errors->has('file'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <textarea type="text" name="message" id="message"
                                    class="form-control h-px-100uuuuuuuuuuuuuuuuuuuj8jjjjjjjjjj78
                                    @if($errors->has('message')) is-invalid @endif">{{ old('message') }}</textarea>
                                    <label for="code">Mensaje</label>
                                    @if($errors->has('message'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('message') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="mb-6 col-md-1">
                                <button type="submit"  class="btn btn-primary float-end">
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
    $(document).ready(function() {
        $('#rfc_suppliers_id').select2();

        $('#saveRequest').click(function (e) {
            e.preventDefault();
            if ($('#file').val() == '') {
                Swal.fire({
                    title: '¿Está seguro de enviar el mensaje sin archivo?',
                    text: "No podra modificar el mensaje!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, estoy seguro!',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-outline-danger waves-effect'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = document.getElementById('formRequestSupplier');
                        form.submit();
                    }
                })
            }
        });
    });
</script>
@endsection
