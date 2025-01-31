@extends('layouts.app')
@section('title', 'Empresas - Crear')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Nueva Empresa</h5>

                        <a href="{{ route('business.index') }}" class="btn btn-sm btn-secondary"
                        ><i class="ri-arrow-left-line me-1"></i> Regresar</a>
                    </div>
                    <!-- <h5 class="card-header">Crear Categoría</h5> -->

                    <div class="card-body">
                        <form id="formCategory" class="needs-validation"
                            encType="multipart/form-data"
                            action="{{ route('business.store') }}" method="POST">
                            @csrf
                            <h6>1. Información de la Empresa</h6>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('rfc')) is-invalid @endif"
                                        id="rfc" name="rfc" value="{{ old('rfc') }}"   />
                                        <label for="rfc">RFC</label>
                                        @if($errors->has('rfc'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('rfc') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('name_fantasy')) is-invalid @endif"
                                        id="name_fantasy" name="name_fantasy" value="{{ old('name_fantasy') }}"/>
                                        <label for="name_fantasy">Nombre</label>
                                        @if($errors->has('name_fantasy'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name_fantasy') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('number_plant')) is-invalid @endif"
                                        id="number_plant" name="number_plant" value="{{ old('number_plant') }}"  />
                                        <label for="number_plant">Numero de Planta Industrial</label>
                                        @if($errors->has('number_plant'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('number_plant') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="file"
                                        class="form-control @if($errors->has('file_positive_opinion')) is-invalid @endif"
                                        id="file_positive_opinion" name="file_positive_opinion"  />
                                        <label for="file_positive_opinion">PDF Opinión Positiva</label>
                                        @if($errors->has('file_positive_opinion'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file_positive_opinion') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="file"
                                        class="form-control @if($errors->has('file_bank_information')) is-invalid @endif"
                                        id="file_bank_information" name="file_bank_information"  />
                                        <label for="file_bank_information">PDF Información Bancaria</label>
                                        @if($errors->has('file_bank_information'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file_bank_information') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="file"
                                        class="form-control @if($errors->has('file_fiscal_constancy')) is-invalid @endif"
                                        id="file_fiscal_constancy" name="file_fiscal_constancy"  />
                                        <label for="file_fiscal_constancy">PDF Constancia de Situación Fiscal</label>
                                        @if($errors->has('file_fiscal_constancy'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file_fiscal_constancy') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="file"
                                        class="form-control @if($errors->has('file_fiscal_address')) is-invalid @endif"
                                        id="file_fiscal_address" name="file_fiscal_address"  />
                                        <label for="file_fiscal_address">PDF Registro de Domicilio Fiscal</label>
                                        @if($errors->has('file_fiscal_address'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file_fiscal_address') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('phone')) is-invalid @endif"
                                        id="phone" name="phone"  value="{{ old('phone') }}" />
                                        <label for="phone">Teléfono de Empresa</label>
                                        @if($errors->has('phone'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('phone') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <textarea id="main_activity" rows="5"
                                        class="form-control @if($errors->has('main_activity')) is-invalid @endif"
                                        name="main_activity"> {{ old('main_activity') }}</textarea>
                                        <label for="main_activity">Descripción de actividad Principal de la empresa</label>
                                        @if($errors->has('main_activity'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('main_activity') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('country')) is-invalid @endif"
                                        id="country" name="country" value="{{ old('country') }}"/>
                                        <label for="country">País</label>
                                        @if($errors->has('country'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('country') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('state')) is-invalid @endif"
                                        id="state" name="state"  value="{{ old('state') }}"  />
                                        <label for="state">Estado</label>
                                        @if($errors->has('state'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('state') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('municipality')) is-invalid @endif"
                                        id="municipality" name="municipality" value="{{ old('municipality') }}"  />
                                        <label for="municipality">Municipio</label>
                                        @if($errors->has('municipality'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('municipality') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('colony')) is-invalid @endif"
                                        id="colony" name="colony" value="{{ old('colony') }}"  />
                                        <label for="colony">Colonia</label>
                                        @if($errors->has('colony'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('colony') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('street')) is-invalid @endif"
                                        id="street" name="street"  value="{{ old('street') }}" />
                                        <label for="street">Calle</label>
                                        @if($errors->has('street'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('street') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('street_number')) is-invalid @endif"
                                        id="street_number" name="street_number" value="{{ old('street_number') }}"  />
                                        <label for="street_number">Numero de Calle</label>
                                        @if($errors->has('street_number'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('street_number') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('postal_code')) is-invalid @endif"
                                        id="postal_code" name="postal_code" value="{{ old('postal_code') }}"  />
                                        <label for="postal_code">Codigo Postal</label>
                                        @if($errors->has('postal_code'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('postal_code') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-6 mx-n4">
                                <h6>2. Información de Usuario</h6>
                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="text"
                                        class="form-control @if($errors->has('name')) is-invalid @endif"
                                        id="name" name="name" value="{{ old('name') }}"  />
                                        <label for="name">Nombre de Usuario</label>
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="email"
                                        class="form-control @if($errors->has('email')) is-invalid @endif"
                                        id="email" name="email" placeholder="Email" value="{{ old('email') }}" />
                                        <label for="email">Correo Electronico</label>
                                        @if($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input type="password"
                                        class="form-control @if($errors->has('password')) is-invalid @endif"
                                        id="password" name="password" placeholder="Password" />
                                        <label for="password">Contraseña</label>
                                        @if($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-end">
                                <div class="mb-3 col-md-1">
                                    <button type="submit" class="btn btn-primary float-end">
                                        <i class="ri-save-2-line me-1"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
