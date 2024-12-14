@extends('layouts.app')
@section('title', 'Mis Solicitudes - Chat')
@section('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-chat.css')}}" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-5">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex overflow-hidden align-items-center">
                    <div class="flex-shrink-0 avatar">
                        <i class="ri-article-fill ri-40px"></i>
                    </div>
                    <div class="chat-contact-info flex-grow-1 ms-4">
                        <h4 class="m-0 fw-bold">{{ $data->type  }}</h4>
                            <span class="badge
                            @if ($data->status == 'Solicitando')
                                bg-warning
                            @endif
                            @if ($data->status == 'En proceso')
                                bg-info
                            @endif
                            @if ($data->status == 'Aprobado') {
                               bg-success
                            @endif
                            @if ($data->status == 'Rechazado') {
                               bg-danger
                            @endif
                            @if ($data->status == 'Contestada') {
                               bg-primary
                            @endif
                            @if ($data->status == 'Examinada') {
                               bg-secondary
                            @endif">{{$data->status}}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <!-- <i class="ri-arrow-up-down-fill ri-20px cursor-pointer d-sm-inline-flex d-none me-1 btn btn-sm btn-text-secondary btn-icon rounded-pill"
                    title="Cambiar Estatus" data-bs-toggle="modal" data-bs-target="#changeStatus"></i> -->
                    <a href="javascript:void();"  class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#ShowDetails">
                        <i class="ri-eye-line me-1"></i>
                        Ver detalles
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="app-chat card overflow-hidden">
        <div class="row g-0">
            <!-- Chat History -->
            <div class="col app-chat-history">
                <div class="chat-history-wrapper">
                    <div class="chat-history-header border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex overflow-hidden align-items-center">
                                <i class="ri-menu-line ri-24px cursor-pointer d-lg-none d-block me-4"
                                    data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                                <div class="flex-shrink-0 avatar avatar-online">
                                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle"
                                        data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right" />
                                </div>
                                <div class="chat-contact-info flex-grow-1 ms-4">
                                    <h4 class="m-0 fw-bold">{{ $data->user->name  }}</h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">

                            </div>
                        </div>
                    </div>
                    <div class="chat-history-body">
                        <ul class="list-unstyled chat-history">
                            @foreach ($data->chats as $msj)
                            @if ($msj->bussines_request_id == $id)
                            @if ($msj->bussines_id != '')
                            <li class="chat-message chat-message-right">
                                <div class="d-flex overflow-hidden">
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                            <p class="mb-0">{{ $msj->message }}</p>
                                        </div>
                                        @if ($msj->file != '')
                                        <div class="chat-message-text mt-2">
                                            <a href="{{asset($msj->file)}}" target="_blank" class="mb-0 text-white ">{{ $msj->name_file }}</a>
                                        </div>
                                        @endif
                                        <div class="text-end text-muted mt-1">
                                            <i class="ri-check-double-line ri-14px text-success me-1"></i>
                                            <small>{{ $msj->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    <div class="user-avatar flex-shrink-0 ms-4">
                                        <div class="avatar avatar-sm">
                                            <img src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @if ($msj->user_admin_id != '')
                            <li class="chat-message">
                                <div class="d-flex overflow-hidden">
                                    <div class="user-avatar flex-shrink-0 me-4">
                                        <div class="avatar avatar-sm">
                                            <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                            <p class="mb-0">{{ $msj->message }}</p>
                                        </div>
                                        @if ($msj->file != '')
                                        <div class="chat-message-text mt-2">
                                            <a href="{{asset($msj->file)}}" target="_blank" class="mb-0 ">{{ $msj->name_file }}</a>
                                        </div>
                                        @endif
                                        <div class="text-muted mt-1">
                                            <small>{{ $msj->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- Chat message form -->
                    <div class="chat-history-footer">
                        <form class="form-send-message d-flex justify-content-between align-items-center"
                            action="{{ route('bussines-request.storeChat', $data->rfc_bussines_id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="rfc_bussines_id" value="{{$data->rfc_bussines_id}}">
                            <input type="hidden" name="bussines_request_id" value="{{$data->rfc_bussines_id}}">
                            <input class="form-control message-input me-4 shadow-none @if ($errors->has('message'))) is-invalid @endif" name="message" type="text"
                                placeholder="Escribe tu mensaje" />
                            <div class="message-actions d-flex align-items-center">
                                <label for="attach-doc" class="form-label mb-0">
                                    <i
                                        class="ri-attachment-2 ri-20px cursor-pointer btn btn-sm btn-text-secondary btn-icon rounded-pill me-2 ms-1 text-heading"></i>
                                    <input type="file" id="attach-doc" hidden name="file" accept="image/png, image/jpeg,image/gif, image/jpg, application/pdf" />
                                </label>
                                <button type="submit" id="send-message" class="btn btn-primary d-flex send-msg-btn">
                                    <span class="align-middle">Enviar</span>
                                    <i class="ri-send-plane-line ri-16px ms-md-2 ms-0"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Chat History -->
            <div class="app-overlay"></div>


        </div>
    </div>

    <div class="modal fade" id="changeStatus" aria-hidden="true" aria-labelledby="changeStatus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalToggleLabel2">Cambiar Estatus</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('bussines-request.changeStatus', $data->rfc_bussines_id) }}" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="mb-3 form-floating form-floating-outline">

                        <select name="status" id="status" class="form-select">
                            <option value="">-- Seleccionar --</option>
                            <option value="Solicitando">Solicitando</option>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Examinada">Examinada</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Rechazado">Rechazado</option>
                            <option value="Contestada">Contestada</option>
                        </select>
                        <label for="status">Estatus</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger"
                        data-bs-target="#changeStatus" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ShowDetails" aria-hidden="true" aria-labelledby="ShowDetails" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalToggleLabel2">Detalles de Solicitud</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Empresa</h6>
                                    <p class="text-body">{{ $data->bussines->name  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Titulo de Solicitud</h6>
                                    <p class="text-body">{{ $data->type  }}</p>
                                </div>
                            </div>
                        </div>
                        @if ($data->type_solicitude == 'Producto')
                        <div class="col-md-4">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Nombre del producto / dispositivo</h6>
                                    <p class="text-body">{{ $data->products->product_name  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Modelo</h6>
                                    <p class="text-body">{{ $data->products->model  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Marca</h6>
                                    <p class="text-body">{{ $data->products->brand  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Cantidad</h6>
                                    <p class="text-body">{{ $data->products->quantity  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Presupuesto aproximado para invertir</h6>
                                    <p class="text-body">{{ $data->products->budget  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Tipo de servicio</h6>
                                    <p class="text-body">{{ $data->products->urgency  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Descripción</h6>
                                    <p class="text-body">{{ $data->products->description  }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Link Drive</h6>
                                    <a href="{{ asset($data->products->link_drive) }}" target="_blank">{{ $data->products->link_drive  }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex align-items-center" >
                                <div class="flex-grow-1">
                                    <h6 class="m-0 fw-bold">Archivo de Solicitud</h6>
                                    @if ($data->products->file == '')
                                    <p class="text-body">No tiene archivo</p>
                                    @else
                                    <p class="text-body"><a href="{{ asset($data->file) }}" target="_blank" Download >Descargar</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @endif

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger"
                        data-bs-target="#ShowDetails" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Vendors JS -->
<script src="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
<!-- Page JS -->
<script src="{{asset('assets/js/app-chat2.js')}}"></script>
@endsection
