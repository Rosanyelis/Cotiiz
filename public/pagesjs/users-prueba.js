/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-user');

$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: "/gestion-de-usuarios-prueba",
            dataType: 'json',
            type: "POST",
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            columns: [
                {
                    data: 'rfcbussines',
                    title: 'Empresa',
                    render: function (data, type, row) {
                        if (data && data.length > 0) {
                            return data.map(bussines => bussines.name).join(', '); // Retorna nombres separados por coma
                        }
                        return 'Sin empresas';
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'status', name: 'status'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [4],
                    render: function (data, type, row)
                    {
                        if (data == 1) {
                            return '<span class="badge bg-success">Aprobado</span>';
                        }
                        if (data == 0) {
                            return '<span class="badge bg-warning">Por Aprobacion</span>';
                        }
                        if (data == 2) {
                            return '<span class="badge bg-danger">Bloqueado</span>';
                        }
                    }
                },
            ]

        });
    }

});

function changePassword(id, name) {
    // Función para manejar el cambio de contraseña de un usuario específico.

    $('#modalChangePassword').find('.modal-title').text('Cambiar contraseña de ' + name);
    // Cambia el título del modal a "Cambiar contraseña de [nombre del usuario]".

    $('#modalChangePassword').find('#id').val(id);
    // Asigna el ID del usuario al campo oculto en el modal.

    // Solicitud AJAX para obtener la contraseña actual
    $.ajax({
        url: '/gestion-de-usuarios-prueba/' + id + '/get-password', // Ruta para obtener la contraseña
        type: 'GET', // Método HTTP utilizado para la solicitud.
        success: function(response) {
            // Función que se ejecuta si la solicitud tiene éxito.
            $('#modalChangePassword').find('#password').val(response.passwordshow);
            // Rellena el campo de contraseña en el modal con la contraseña obtenida.
        },
        error: function(xhr) {
            // Función que se ejecuta si ocurre un error en la solicitud.
            Swal.fire({
                icon: 'error', // Muestra un icono de error.
                title: 'Error', // Título del mensaje de error.
                text: 'No se pudo obtener la contraseña actual.', // Mensaje descriptivo.
                confirmButtonText: 'Aceptar' // Texto del botón de confirmación.
            });
        }
    });

    // Mostrar el modal
    $('#modalChangePassword').modal('show');
    // Muestra el modal con el ID `modalChangePassword` para que el usuario pueda cambiar la contraseña.
}

// === Gestión de Contraseñas ===
$(document).on('click', '#toggle-password', function() {
    // Escucha el evento de clic en el botón con ID `toggle-password`.
    // Esta funcionalidad alterna entre mostrar y ocultar la contraseña.

    const passwordField = $('#password');
    // Obtiene el campo de entrada de la contraseña.

    const passwordFieldType = passwordField.attr('type');
    // Obtiene el atributo `type` del campo de entrada, que puede ser `password` o `text`.

    if (passwordFieldType === 'password') {
        // Si el campo está configurado para ocultar la contraseña...
        passwordField.attr('type', 'text'); // Cambia el tipo a texto para mostrar la contraseña.
        $(this).html('<i class="ri-eye-off-line"></i>');
        // Cambia el contenido del botón a un ícono que representa "ocultar contraseña".
    } else {
        // Si el campo está configurado para mostrar la contraseña...
        passwordField.attr('type', 'password'); // Cambia el tipo a password para ocultar la contraseña.
        $(this).html('<i class="ri-eye-line"></i>');
        // Cambia el contenido del botón a un ícono que representa "mostrar contraseña".
    }
});

function activated(id) {
    console.log(id);

    Swal.fire({
        title: '¿Está seguro de activar este usuario?',
        text: "El usuario podra acceder al sistema con sus credenciales!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, activar!',
        cancelButtonText: 'Cancelar',
        customClass: {
        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                "/gestion-de-usuarios-prueba/"+id+"/activated";
        }
    })
}

function desactivarRecord(id) {
    Swal.fire({
        title: '¿Está seguro de Desactivar este Usuario?',
        text: "No podra acceder al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Desactivar!',
        cancelButtonText: 'Cancelar',
        customClass: {
        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                "/gestion-de-usuarios-prueba/"+id+"/desactivated";
        }
    })
}

function deleted(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar este Usuario?',
        text: "El usuario sera eliminado permanentemente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar',
        customClass: {
        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                "/gestion-de-usuarios-prueba/"+id+"/delete";
        }
    })
}
