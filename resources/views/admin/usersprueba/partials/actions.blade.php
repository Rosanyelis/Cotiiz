<button class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill dropdown-toggle hide-arrow"
    data-bs-toggle="dropdown" aria-expanded="false">
    <!-- Botón con clases de estilo de Bootstrap para tamaño pequeño (btn-sm),
         icono y texto secundarios, bordes redondeados, y un ícono que se utiliza 
         como parte de un menú desplegable. -->
    <i class="ri-more-2-line ri-20px"></i>
    <!-- Ícono dentro del botón usando la biblioteca de íconos "Remix Icon".
         El ícono `ri-more-2-line` representa un menú de más opciones y 
         `ri-20px` define su tamaño a 20px. -->
</button>

<div class="dropdown-menu dropdown-menu-end m-0" style="">
    <!-- Menú desplegable asociado al botón anterior. 
         `dropdown-menu` es una clase de Bootstrap para menús desplegables.
         `dropdown-menu-end` alinea el menú hacia la derecha.
         `m-0` elimina cualquier margen adicional del menú. -->

    <a class="dropdown-item text-info" href="{{ route('admin.prueba-users.show', $data->id) }}">
        <!-- Opción de menú con clase `dropdown-item`, que es un enlace interactivo.
             `text-info` aplica un color de texto (normalmente azul claro).
             `href` genera una URL usando una ruta definida en Laravel, 
             pasando el ID del usuario (`$data->id`) como parámetro. -->
        <i class="ri-eye-line ri-20px"></i> <!-- Ícono "Ver" usando Remix Icon. -->
        Ver Usuario <!-- Mensaje de accion. -->
    </a>

    <a class="dropdown-item text-info" href="javascript:0;"
        onclick="changePassword({{ $data->id }}, '{{ $data->name }}')">
        <!-- Opción de menú que no redirige a una URL, sino que llama a la función 
             JavaScript `changePassword` con los datos del usuario como parámetros: 
             el ID y el nombre del usuario. -->
        <i class="ri-edit-2-line ri-20px"></i><!-- Ícono "Editar" para cambiar la contraseña. -->
        Cambiar Contraseña<!-- Mensaje de accion. -->
    </a>

    @if ($data->status == 0 || $data->status == 2)
        <!-- Condición en Blade que muestra esta sección si el estado del usuario
             es 0 (inactivo) o 2 (desactivado). -->
        <a class="dropdown-item text-danger" href="#" onclick="activated({{ $data->id }})">
            <!-- Opción que llama a la función `activated` en JavaScript para activar al usuario. 
                 `text-danger` aplica un color de texto rojo para indicar acción crítica. -->
            <i class="ri-delete-bin-fill ri-20px"></i>
            <!-- Ícono para activar el usuario. (El ícono puede confundir, ya que parece de eliminación). -->
            Activar Usuario<!-- Mensaje de accion. -->
        </a>
    @endif

    <!-- Condición en Blade que muestra esta sección si el estado del usuario es 1 (activo). -->
    @if ($data->status == 1)
        <a class="dropdown-item text-danger" href="#" onclick="desactivarRecord({{ $data->id }})"><!-- Opción que llama a la función `desactivarRecord` en JavaScript para desactivar al usuario. -->
            <i class="ri-delete-bin-fill ri-20px"></i><!-- Ícono para desactivar al usuario. -->
            Desactivar Usuario
            <!-- Mensaje de accion. -->
        </a>
    @endif

    <!-- Condición en Blade que muestra esta sección si el estado del usuario es 0 (inactivo) o 1 (activo). -->
    @if ($data->status == 0 or $data->status == 1)
        <a class="dropdown-item text-danger" href="#" onclick="deleted({{ $data->id }})"><!-- Opción que llama a la función `deleted` en JavaScript para eliminar al usuario. -->
            <i class="ri-delete-bin-7-line ri-20px"></i><!-- Ícono para eliminar al usuario. -->
            Eliminar Usuario<!-- Mensaje de accion. -->
        </a>
    @endif
</div>
