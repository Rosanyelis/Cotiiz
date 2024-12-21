                    <div class="card-body mt-1">
                        <h4 class="mb-5 text-center">Regístrese en Cotiz</h4>
                        <form id="formAuthentication" class="mb-5 needs-validation row" method="POST"
                        action="{{ route('register.store.supplier') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <hr class="my-6 mx-n4">
                            <h6>1. Información del Proveedor</h6>

                            <input type="hidden" name="tipo" value="{{ $tipo }}">

                            <div class="col-md-12">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('rfc')) is-invalid @endif"
                                    id="rfc" name="rfc" value="{{ old('rfc', $rfc) }}" readonly  />
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
                                    <label for="name_fantasy">Nombre de Empresa</label>
                                    @if($errors->has('name_fantasy'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name_fantasy') }}
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
                                    class="form-control @if($errors->has('file_positive_opinion')) is-invalid @endif"
                                    id="file_positive_opinion" name="file_positive_opinion"  />
                                    <label for="file_positive_opinion">PDF Opinión Positiva Actualizada</label>
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
                                    class="form-control @if($errors->has('file_credit_acceptance_letter')) is-invalid @endif"
                                    id="file_credit_acceptance_letter" name="file_credit_acceptance_letter"  />
                                    <label for="file_credit_acceptance_letter">PDF Carta de Aceptación de Crédito</label>
                                    @if($errors->has('file_credit_acceptance_letter'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_credit_acceptance_letter') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_list_product_service')) is-invalid @endif"
                                    id="file_list_product_service" name="file_list_product_service"  />
                                    <label for="file_list_product_service">PDF Listado de Productos y Servicios</label>
                                    @if($errors->has('file_list_product_service'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_list_product_service') }}
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

                            <div class="w-100"></div>


                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" type="submit">Registrarme</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>¿Posees una cuenta?</span>
                            <a href="{{ route('login') }}">
                                <span>Ingresar</span>
                            </a>
                        </p>
                    </div>
