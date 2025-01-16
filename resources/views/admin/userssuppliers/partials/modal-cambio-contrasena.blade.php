<!-- Modal agregar numero de factura y cargar archivo -->
<div class="modal fade" id="modalChangePassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Cambiar contraseña de <span id="user"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.supplier-users.changePasword') }}" method="POST" enctype="multipart/form-data" id="my-form-invoice">
                @csrf
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <!-- Contraseña Actual -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input
                            type="text"
                            id="current_password"
                            name="current_password"
                            class="form-control"
                            placeholder="Contraseña Actual"
                            readonly
                        />
                    </div>

                    <!-- Nueva Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <div class="input-group">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Nueva Contraseña"
                            />
                            <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                                <i class="ri-eye-line"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!--/ Modal agregar numero de factura y cargar archivo -->
