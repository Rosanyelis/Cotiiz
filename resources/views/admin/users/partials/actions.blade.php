
<button class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="ri-more-2-line ri-20px"></i>
</button>
<div class="dropdown-menu dropdown-menu-end m-0" style="">
        <a class="dropdown-item text-info" href="{{ route('admin.users.edit', $data->id) }}">
            <i class="ri-edit-2-line ri-20px"></i>
            Editar Usuario
        </a>

        @if ($data->status == 0 || $data->status == 2)
        <a class="dropdown-item text-danger" href="#" onclick="activated({{ $data->id }})" >
            <i class="ri-delete-bin-fill ri-20px"></i>
            Activar Usuario
        </a>
        @endif

        @if ($data->status == 1)
        <a class="dropdown-item text-danger" href="#" onclick="desactivarRecord({{ $data->id }})" >
            <i class="ri-delete-bin-fill ri-20px"></i>
            Desactivar Usuario
        </a>
        @endif

</div>
