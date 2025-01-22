<a href="{{ route('admin.product.show', $data->id) }}" class="btn btn-sm btn-icon btn-text-info rounded-pill"
    data-bs-toggle="tooltip" title="Ver Producto">
    <i class="ri-eye-line ri-20px"></i>
</a>

@if ($data->status === 'Pendiente')
    <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill text-success"
        data-bs-toggle="tooltip" title="Aprobar Producto"
        onclick="handleProductAction('aprove', {{ $data->id }})">
        <i class="ri-check-line ri-20px"></i>
    </a>
    <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill text-danger"
        data-bs-toggle="tooltip" title="Rechazar Producto"
        onclick="handleProductAction('reject', {{ $data->id }})">
        <i class="ri-close-line ri-20px"></i>
    </a>
@elseif ($data->status === 'Aprobado')
    <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill text-success disabled"
        data-bs-toggle="tooltip" title="Este producto ya está aprobado y no puede aprobarse nuevamente">
        <i class="ri-check-line ri-20px"></i>
    </a>
    <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill text-danger"
        data-bs-toggle="tooltip" title="Rechazar Producto"
        onclick="handleProductAction('reject', {{ $data->id }})">
        <i class="ri-close-line ri-20px"></i>
    </a>
@elseif ($data->status === 'Rechazado')
    <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill text-success"
        data-bs-toggle="tooltip" title="Aprobar Producto"
        onclick="handleProductAction('aprove', {{ $data->id }})">
        <i class="ri-check-line ri-20px"></i>
    </a>
    <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill text-danger disabled"
        data-bs-toggle="tooltip" title="Este producto ya está rechazado y no puede rechazarse nuevamente">
        <i class="ri-close-line ri-20px"></i>
    </a>
@endif
