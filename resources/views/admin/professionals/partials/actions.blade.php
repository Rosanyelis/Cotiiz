<a href="{{ route('admin.professional.show', $data->id) }}" class="btn btn-sm btn-icon btn-text-info
    rounded-pill"
    data-bs-toggle="tooltip" title="Ver Profesional">
    <i class="ri-eye-line ri-20px"></i>
</a>
<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-success"
    data-bs-toggle="tooltip" title="Aprobar Profesional"
    onclick="aceptedRecord({{ $data->id }})">
    <i class="ri-check-line ri-20px"></i>
</a>
<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-danger"
    data-bs-toggle="tooltip" title="Rechazar Profesional"
    onclick="rejectRecord({{ $data->id }})">
    <i class="ri-close-line ri-20px"></i>
</a>
