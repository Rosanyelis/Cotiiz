/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-subaccount');
$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: "/subcuentas",
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
                {data: 'principal', name: 'principal'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
            ],
            columnDefs: [
                {
                    targets: [1],
                    render: function (data, type, row)
                    {
                        if (data == 'Si') {
                            return '<span class="badge bg-success">Principal</span>';
                        }
                        if (data == 'No') {
                            return '<span class="badge bg-warning">Secundaria</span>';
                        }
                    }
                },
                {
                targets: [3],
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
            }]
        });
    }

});
function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar este Gasto?',
        text: "No podra recuperar la información!",
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
                "/gastos/"+id+"/delete";
        }
    })
}
