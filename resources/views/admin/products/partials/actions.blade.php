<a href="{{ route('admin.product.show', $data->id) }}" class="btn btn-sm btn-icon btn-text-info
    rounded-pill"
    data-bs-toggle="tooltip" title="Ver Producto">
    <i class="ri-eye-line ri-20px"></i>
</a>
<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-success"
    data-bs-toggle="tooltip" title="Aprobar Producto"
    onclick="aceptedRecord({{ $data->id }})">
    <i class="ri-check-line ri-20px"></i>
</a>
<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-danger"
    data-bs-toggle="tooltip" title="Rechazar Producto"
    onclick="rejectRecord({{ $data->id }})">
    <i class="ri-close-line ri-20px"></i>
</a>
