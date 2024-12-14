/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-admin-profesional');
    const numberFormat2 = new Intl.NumberFormat('es-MX');
    const baseStorage = document.querySelector('html').getAttribute('data-base-url');
$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/gestion-de-profesionales",
            },
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
                    data: 'rfc_supplier',
                    name: 'rfc_supplier'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'photo',
                    name: 'photo'
                },
                {
                    data: 'fullname',
                    name: 'fullname',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'occupation',
                    name: 'occupation'
                },
                {
                    data: 'specialty',
                    name: 'specialty'
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
                targets: [2],
                render: function (data) {
                    if (data === null || data === "") {
                        return '<img src="'+ baseStorage +'/assets/img/products/no-photo.jpg" alt="" class="rounded-circle avatar-sm" />';
                    } else {
                        return '<img src="' + baseStorage + data + '" alt="" class="rounded-circle avatar-sm" />';
                    }
                }
            },
            {
                targets: [6],
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
function aceptedRecord(id) {
    Swal.fire({
        title: '¿Está seguro de Aprobar este Profesional?',
        text: "No podra recuperar la información!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Aprobar!',
        cancelButtonText: 'Cancelar',
        customClass: {
        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
            "/gestion-de-profesionales/"+id+"/aprove";
        }
    })

}

function rejectRecord(id) {
    Swal.fire({
        title: '¿Está seguro de Rechazar este Profesional?',
        text: "No podra recuperar la información!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, Rechazar!',
        cancelButtonText: 'Cancelar',
        customClass: {
        confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
        cancelButton: 'btn btn-outline-danger waves-effect'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                "/gestion-de-profesionales/"+id+"/reject";
        }
    })
}
