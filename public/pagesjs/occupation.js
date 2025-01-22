/**
 * DataTables Advanced (jquery)
 */

'use strict';
    var dt_ajax_table = $('.datatables-occupation');

    $(function () {
        if (dt_ajax_table.length) {
            var dt_ajax = dt_ajax_table.DataTable({
                processing: true,
                serverSide: true,
                ajax: "/profesiones",
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
                    { data: 'name', name: 'name' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ],
            });
    
            // Botón "Ir al Inicio"
            $('#go-to-first').on('click', function () {
                dt_ajax.page('first').draw('page');
            });
    
            // Botón "Ir al Final"
            $('#go-to-last').on('click', function () {
                dt_ajax.page('last').draw('page');
            });
        }
    });
    
    function deleteRecord(id) {
        Swal.fire({
            title: '¿Está seguro de eliminar esta Profesión?',
            text: "No podrá recuperar la información!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                cancelButton: 'btn btn-outline-danger waves-effect'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href =
                    "/profesiones/" + id + "/eliminar";
            }
        });
    }

