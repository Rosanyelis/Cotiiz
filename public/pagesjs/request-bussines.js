'use strict';
var dt_ajax_table = $('.datatables-bussines-request');

$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/mis-solicitudes/datatable",
                type: "POST",
                data: function(d) {
                    d.is_test = $('#filter-is-test').val(); // Filtro dinámico
                }
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            columns: [
                { data: 'type_solicitude', name: 'type_solicitude', render: function(data) {
                    return `<span class="text-capitalize">${data}</span>`;
                }},
                { data: 'status', name: 'status' },
                { data: 'is_test', name: 'is_test', render: function(data) {
                    return data ? '<span class="badge bg-info">Prueba</span>' : '<span class="badge bg-primary">Normal</span>';
                }},
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ],
            columnDefs: [
                {
                    targets: [1],
                    render: function (data) {
                        if (data == 'Solicitando') {
                            return `<span class="badge bg-warning">${data}</span>`;
                        }
                        if (data == 'En proceso') {
                            return `<span class="badge bg-info">${data}</span>`;
                        }
                        if (data == 'Aprobado') {
                            return `<span class="badge bg-success">${data}</span>`;
                        }
                        if (data == 'Rechazado') {
                            return `<span class="badge bg-danger">${data}</span>`;
                        }
                        if (data == 'Contestada') {
                            return `<span class="badge bg-primary">${data}</span>`;
                        }
                        if (data == 'Examinada') {
                            return `<span class="badge bg-secondary">${data}</span>`;
                        }
                    }
                }
            ]
        });

        // Filtro por tipo de empresa
        $('#filter-is-test').on('change', function() {
            dt_ajax_table.DataTable().ajax.reload();
        });
    }

    $('#saveRequest').click(function (e) {
        e.preventDefault();
        if ($('#file').val() == '') {
            Swal.fire({
                title: '¿Está seguro de enviar la Solicitud sin archivo?',
                text: "No podrá modificar la solicitud!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, estoy seguro!',
                cancelButtonText: 'Cancelar',
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-outline-danger waves-effect'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('formRequestSupplier');
                    form.submit();
                }
            });
        }
    });
});

function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar esta Especialidad?',
        text: "No podrá recuperar la información!",
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
            window.location.href = "/especialidades/" + id + "/eliminar";
        }
    });
}
