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
            ajax: "/gestion-de-usuarios-empresas",
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
    $('#modalChangePassword').find('.modal-title').text('Cambiar contraseña de ' + name);
    $('#modalChangePassword').find('#id').val(id);

    // Solicitud AJAX para obtener la contraseña actual
    $.ajax({
        url: '/gestion-de-usuarios-empresas/' + id + '/get-password', // Ruta para obtener la contraseña
        type: 'GET',
        success: function(response) {
            // Rellena el campo de contraseña con el valor obtenido
            $('#modalChangePassword').find('#password').val(response.passwordshow);
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo obtener la contraseña actual.',
                confirmButtonText: 'Aceptar'
            });
        }
    });

    // Mostrar el modal
    $('#modalChangePassword').modal('show');
}

$(document).on('click', '#toggle-password', function() {
    const passwordField = $('#password');
    const passwordFieldType = passwordField.attr('type');

    if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text'); // Cambiar a texto
        $(this).html('<i class="ri-eye-off-line"></i>'); // Cambiar el ícono
    } else {
        passwordField.attr('type', 'password'); // Cambiar a oculto
        $(this).html('<i class="ri-eye-line"></i>'); // Cambiar el ícono
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
                "/gestion-de-usuarios-empresas/"+id+"/activated";
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
                "/gestion-de-usuarios-empresas/"+id+"/desactivated";
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
                "/gestion-de-usuarios-empresas/"+id+"/delete";
        }
    })
}
