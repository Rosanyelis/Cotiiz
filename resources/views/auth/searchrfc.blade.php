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
                    <form  class="needs-validation" method="GET"  action="{{ route('view.register') }}" >
                        @csrf
                        <div class="card-body mt-1">
                            <h4 class="mb-5 text-center">Regístrese en Cotiz</h4>
                            <div class="form-floating form-floating-outline mb-5">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="rfc"
                                    name="rfc"
                                    placeholder="Ingrese el rfc"
                                    autofocus />
                                <label for="rfc">Buscar RFC de {{ $tipo }}</label>
                                <span class="invalid-feedback" id="rfc-error"></span>
                                <span class="valid-feedback" id="rfc-success"></span>
                            </div>
                            <input type="hidden" name="tipo" value="{{ $tipo }}">
                            <div class="mb-5" id="btnSearchDiv">
                                <button type="button" class="btn btn-primary d-grid w-100"  id="btnSearch">Buscar</button>
                            </div>
                            <div class="mb-5" id="btn_searchDiv">
                                <button type="submit" class="btn btn-primary d-grid w-100" id="btn_search"></button>
                            </div>
                        </div>
                    </form>
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

        $("#rfc-error").hide();
        $("#btn_searchDiv").hide();
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
                        $("#btn_searchDiv").show();
                        $("#btn_search").prop('disabled', false);
                        $("#btn_search").html("Continuar con el registro de la Empresa");
                    } else {
                        $("#rfc-error").hide();
                        $("#rfc-success").text("La empresa ya se encuentra registrada");
                        $("#rfc-success").show();
                        $('#btnSearchDiv').hide();
                        $("#btn_searchDiv").show();
                        $("#btn_search").prop('disabled', false);
                        $("#btn_search").html("Registrarme como usuario de la Empresa");
                    }
                }
            });
        })

    });
</script>

@endSection
