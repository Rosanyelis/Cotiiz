<!-- Modal agregar numero de factura y cargar archivo -->
<div class="modal fade" id="modalCashback" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Agregar CashBack <span id="correlativo"></span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('business.store_cashback') }}" method="POST" enctype="multipart/form-data" id="my-form-invoice">
                    @csrf
                    <input type="hidden" id="rfc" name="rfc">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class=" col-md-12">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="number"
                                    id="cashback"
                                    name="cashback"
                                    class="form-control @if($errors->has('cashback')) is-invalid @endif"
                                    value="{{ old('cashback') }}"
                                />
                                <label for="code">CashBack</label>
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
