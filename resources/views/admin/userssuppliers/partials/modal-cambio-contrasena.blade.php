<!-- Modal agregar numero de factura y cargar archivo -->
<div class="modal fade" id="modalChangePassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Cambiar Contraseña del Usuario <span id="user"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.supplier-users.changePasword') }}" method="POST" enctype="multipart/form-data" id="my-form-invoice">
                    @csrf
                    <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class=" col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @if($errors->has('password')) is-invalid @endif"
                                    value="{{ old('password') }}"
                                />
                                <label for="code">Contraseña</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancelar</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Guardar</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--/ Modal agregar numero de factura y cargar archivo -->
