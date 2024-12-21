toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
function notify() {
    $.ajax({
        url: "/notificaciones-de-proveedor",
        type: "GET",
        success: function (response) {
            $('#list-notify').empty();
            if (response != null) {
                let last = response.lastNotify;
                if (last.status == 'No Leido') {
                    toastr.info(last.message);
                }

                if (response.data.length > 0) {
                    if (last.status == 'No Leido') {
                        toastr.info('Tienes notificaciones pendientes de leer.');
                    }
                    response.data.forEach(function (notify) {
                        if (notify.status == 'No Leido' ) {
                            $('#list-notify').append(
                            `<li
                                class="list-group-item list-group-item-action dropdown-notifications-item ">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-info"><i
                                                    class="ri-error-warning-line"></i></span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 small">`+ notify.title +`</h6>
                                        <small class="mb-1 d-block text-body">`+ notify.message +`</small>
                                        <small class="text-muted">`+ moment(notify.created_at).startOf('hour').fromNow()   +`</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" onclick="readNotification(`+ notify.id +`)" class="dropdown-notifications-read">
                                            <span class="badge badge-dot"></span>
                                        </a>
                                        <a href="javascript:void(0)" onclick="deleteNotification(`+ notify.id +`)" class="dropdown-notifications-archive">
                                            <span class="ri-close-line ri-20px"></span>
                                        </a>
                                    </div>
                                </div>
                            </li>`
                            );
                        }
                        if (notify.status == 'Leido' ) {
                            $('#list-notify').append(
                            `<li
                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-info"><i
                                                    class="ri-error-warning-line"></i></span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 small">`+ notify.title +`</h6>
                                        <small class="mb-1 d-block text-body">`+ notify.message +`</small>
                                        <small class="text-muted">`+ moment(notify.created_at).startOf('hour').fromNow()   +`</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <a href="javascript:void(0)" onclick="deleteNotification(`+ notify.id +`)" class="dropdown-notifications-archive">
                                            <span class="ri-close-line ri-20px"></span>
                                        </a>
                                    </div>
                                </div>
                            </li>`
                            );
                        }


                    });
                }
            }

        }
    });
}

function markAsRead() {
    $.ajax({
        url: "/notificaciones-de-proveedor/marcar-leido",
        type: "GET",
        success: function (response) {
            $('#list-notify').empty();
            // mostramos un spinner de carga
            $('#list-notify').append(
                `<div class="sk-chase sk-primary">
                    <div class="sk-chase-dot"></div>
                </div>`
            );

            notify();
        }
    });
}

function readNotification(id) {
    $.ajax({
        url: "/notificaciones-de-proveedor/" + id + "/read",
        type: "GET",
        success: function (response) {
            $('#list-notify').empty();
            // mostramos un spinner de carga
            $('#list-notify').append(
                `<div class="sk-chase sk-primary">
                    <div class="sk-chase-dot"></div>
                </div>`
            );

            notify();
        }
    });
}

function deleteNotification(id) {
    $.ajax({
        url: "/notificaciones-de-proveedor/" + id + "/delete",
        type: "GET",
        success: function (response) {
            $('#list-notify').empty();
            // mostramos un spinner de carga
            $('#list-notify').append(
                `<div class="sk-chase sk-primary">
                    <div class="sk-chase-dot"></div>
                </div>`
            );

            notify();
        }
    });
}

function navDashboardToNotify() {
    $.ajax({
        url: "/metricas-proveedor",
        type: "GET",
        success: function (response) {
            console.log(response);

            $('#prov-buzon').text(response.totalmensajes);
            $('#prov-solicitudes').text(response.totalsolicitudproveedor);
            $('#prov-productos').text(response.totalproductos);
            $('#prov-servicios').text(response.totalservicios);
            $('#prov-profesionales').text(response.totalprofesionales);


        }
    });
}

notify();
navDashboardToNotify();

// recargar la function cada 1 minuto
setInterval(function () {
    notify();
    navDashboardToNotify();
}, 60000);
