/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-bussines-user');
    var idrfc = $('.datatables-bussines-user').data('rfc');
    var url = "/proveedores/"+idrfc+"/users";
$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: url,
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
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'principal', name: 'principal'},
                {data: 'status', name: 'status'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [2],
                    render: function (data) {
                        if (data == 'Si') {
                            return '<span class="badge bg-info">Principal</span>';
                        }
                        if (data == 'No') {
                            return '<span class="badge bg-secondary">Secundario</span>';
                        }
                    }
                },
                {
                    targets: [3],
                    render: function (data) {
                        if (data == 0) {
                            return '<span class="badge bg-warning">Por Aprobacion</span>';
                        }
                        if (data == 1) {
                            return '<span class="badge bg-success">Aprobado</span>';
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
                "/proveedores/users/"+id+"/activated";
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
                "/proveedores/users/"+id+"/desactivated";
        }
    })
}
