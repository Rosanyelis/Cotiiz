/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-bussines');

$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: "/pruebas",
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
                {data: 'name_fantasy', name: 'name_fantasy'},
                {data: 'street', name: 'street'},
                {data: 'street_number', name: 'street_number'},
                {data: 'colony', name: 'colony'},
                {data: 'status', name: 'status'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [5],
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
        title: '¿Está seguro de Activar esta Empresa?',
        text: "Los usuarios relacionados podran acceder al sistema con sus credenciales!",
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
                "/pruebas/"+id+"/activated";
        }
    })
}

function desactivarRecord(id) {
    Swal.fire({
        title: '¿Está seguro de Desactivar esta Empresa?',
        text: "Los usuarios relacionados No podran acceder al sistema!",
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
                "/pruebas/"+id+"/desactivated";
        }
    })
}


function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de Eliminar este Proveedor?',
        text: "Cualquier información relacionada se perdera!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Eliminar!',
        cancelButtonText: 'Cancelar',
        customClass: {
        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                "/pruebas/"+id+"/delete";
        }
    });
}
