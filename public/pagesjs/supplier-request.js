/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-request-supplier');

$(function () {

    if (dt_ajax_table.length) {
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            ajax: "/solicitudes-de-proveedor/datatable",
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
                {data: 'supplier.name', name: 'supplier.name'},
                {data: 'type', name: 'type'},
                {data: 'status', name: 'status'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [2],
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
    }

    $('#saveRequest').click(function (e) {
        e.preventDefault();
        if ($('#file').val() == '') {
            Swal.fire({
                title: '¿Está seguro de enviar la Solicitud sin archivo?',
                text: "No podra modificar la solicitud!",
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
            })
        }
    });

});

document.getElementById('supplier-search').addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase(); // Convierte el texto de búsqueda a minúsculas
        const supplierList = document.getElementById('rfc_suppliers_id');

        // Itera a través de las opciones del select y oculta/muestra según la búsqueda
        Array.from(supplierList.options).forEach(option => {
            const supplierName = option.text.toLowerCase(); // Convierte el texto del proveedor a minúsculas
            if (supplierName.includes(searchQuery)) {
                option.style.display = ''; // Muestra la opción si coincide con la búsqueda
            } else {
                option.style.display = 'none'; // Oculta la opción si no coincide
            }
        });
    });

function deleteRecord(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar esta Especialidad?',
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
                "/especialidades/"+id+"/eliminar";
        }
    })
}
