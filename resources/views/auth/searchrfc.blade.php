@extends('auth.layouts.app')
@section('title', 'Buscar RFC')
@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
@endsection
@section('content')
    <div class="position-relative" style="background-image: url('{{ asset('web/images/bg-login.jpg') }}');background-repeat: no-repeat;background-size: cover;">
        <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0" >
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card p-md-7 p-1">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <img  src="{{ asset('assets/img/logo-cotiz.png') }}" width="25%" alt="logo" />
                    </div>
                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        <h4 class="mb-5 text-center">Regístrese en Cotiz</h4>
                        <div class="form-floating form-floating-outline mb-5">
                            <input
                                type="text"
                                class="form-control"
                                id="rfc"
                                name="rfcs"
                                placeholder="Ingrese el rfc"
                                autofocus />
                            <label for="rfc">Buscar RFC de {{ $tipo }}</label>
                            <span class="invalid-feedback" id="rfc-error"></span>
                            <span class="valid-feedback" id="rfc-success"></span>
                        </div>
                        <div class="mb-5" id="btnSearchDiv">
                            <button type="button" class="btn btn-primary d-grid w-100"  id="btnSearch">Buscar</button>
                        </div>
                        <div class="mb-5 " id="btn_searchDiv">
                            <form  class="needs-validation" method="GET"  action="{{ route('view.register') }}" >
                            @csrf
                                <input type="hidden" name="tipo" value="{{ $tipo }}">
                                <input type="hidden" name="rfc" id="rfc_new">
                                <button type="submit" class="btn btn-primary d-grid w-100" id="btn_search"></button>
                            </form>
                        </div>
                        <div class="mb-5" id="btn_registerPruebaDiv">
                            <form  class="needs-validation" method="GET"  action="{{ route('view.register') }}" >
                            @csrf
                                <input type="hidden" name="tipo" value="Empresa-Prueba">
                                <input type="hidden" name="rfc" id="rfc_prueba">
                                <button type="submit" class="btn btn-secondary d-grid w-100 mt-2">Registrarme como Empresa de Prueba</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script>

    $(document).ready(function () {
        var tipo = "{{ $tipo }}";
        $("#rfc-error").hide();
        $("#btn_searchDiv").hide();
        $("#btn_registerPruebaDiv").hide();
        $("#btn_search").prop('disabled', true);
        $('#btnSearch').on('click', function () {
            $.ajax({
                url: "{{ route('tipo.searchRfc', $tipo) }}",
                dataType: "json",
                data: {
                    term: $("#rfc").val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    console.log(data.name);
                    if (data.name == null) {
                        $("#rfc-error").text("No hay Empresas registradas con este RFC");
                        $("#rfc-error").show();
                        $('#btnSearchDiv').hide();

                        if (tipo == 'proveedor') {
                            $("#btn_searchDiv").show();
                            $("#btn_search").prop('disabled', false);
                            $("#btn_search").html("Registrar Proveedor");
                            $("#rfc_new").val($("#rfc").val());

                        }
                        if (tipo == 'empresa') {
                            $("#btn_searchDiv").show();
                            $("#btn_registerPruebaDiv").show();
                            $("#btn_search").prop('disabled', false);
                            $("#btn_search").html("Registrar Empresa");
                            $("#rfc_new").val($("#rfc").val());
                            $("#rfc_prueba").val($("#rfc").val());
                        }
                    } else {
                        $("#rfc-error").hide();
                        $("#rfc-success").text("La empresa ya se encuentra registrada");
                        $("#rfc-success").show();
                        $("#btn_search").prop('disabled', false);
                        $('#btnSearchDiv').hide();
                        $("#btn_searchDiv").show();
                        $("#rfc_new").val($("#rfc").val());
                        $("#btn_search").prop('disabled', false);
                        $("#btn_search").html("Registrarme como empleado de la Empresa");
                    }
                }
            });
        })

    });
</script>

@endSection
