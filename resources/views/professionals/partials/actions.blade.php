<a href="{{ route('professional.show', $id) }}" class="btn btn-sm btn-icon btn-text-info
    rounded-pill"
    data-bs-toggle="tooltip" title="Ver Profesional">
    <i class="ri-eye-line ri-20px"></i>
</a>
<a href="{{ route('professional.edit', $id) }}" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill"
    data-bs-toggle="tooltip" title="Editar Profesional">
    <i class="ri-edit-2-line ri-20px"></i>
</a>
<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-danger"
    data-bs-toggle="tooltip" title="Eliminar Profesional"
    onclick="deleteRecord({{ $id }})">
    <i class="ri-delete-bin-7-line ri-20px"></i>
</a>
