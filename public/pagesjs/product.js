/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-product');
    var category = $('#category_id');
    const numberFormat2 = new Intl.NumberFormat('de-DE');
    const baseStorage = document.querySelector('html').getAttribute('data-base-url');
$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/productos/datatable",
            },
            // ajax: "",
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
                    data: 'photo',
                    name: 'photo'
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [
            {
                targets: [0],
                render: function (data) {
                    if (data === null || data === "") {
                        return '<img src="'+ baseStorage +'/assets/img/products/no-photo.jpg" alt="" class="rounded-circle avatar-sm" />';
                    } else {
                        return '<img src="' + baseStorage + data + '" alt="" class="rounded-circle avatar-sm" />';
                    }
                }
            },
            {
                targets: [2],
                render: function (data) {
                    return '$ ' + numberFormat2.format(data);
                }
            },
            {
                targets: [4],
                render: function (data) {
                    if (data === 'Pendiente') {
                        return '<span class="badge bg-warning">Por Aprobación</span>';
                    } else if (data === 'Aprobado') {
                        return '<span class="badge bg-success">Aprobado</span>';
                    } else {
                        return '<span class="badge bg-danger">Rechazado</span>';
                    }
                }
            }
            ],
        });
    }

});
function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar este Producto?',
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
                "/productos/"+id+"/delete";
        }
    })
}
