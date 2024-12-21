@extends('layouts.app')
@section('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css')}}" />
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
                        <h4 class="m-0 fw-bold">Buzón</h4>
                    </div>
                </div>
                <div class="d-flex align-items-center">

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
                                    <h4 class="m-0 fw-bold">Administración</h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">

                            </div>
                        </div>
                    </div>
                    <div class="chat-history-body">
                        <ul class="list-unstyled chat-history">
                        @foreach ($data as $msj)
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
                            @endforeach
                        </ul>
                    </div>
                    <!-- Chat message form -->
                    <div class="chat-history-footer">
                        <form class="form-send-message d-flex justify-content-between align-items-center"
                            action="{{ route('bussines-chat.store') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <input class="form-control message-input me-4 shadow-none @if ($errors->has('message'))) is-invalid @endif" name="message" type="text"
                                placeholder="Escribe tu mensaje a la administración" />
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

</div>
@endsection
@section('scripts')
<!-- Vendors JS -->
<script src="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
<!-- Page JS -->
<script src="{{asset('assets/js/app-chat2.js')}}"></script>
@endsection
