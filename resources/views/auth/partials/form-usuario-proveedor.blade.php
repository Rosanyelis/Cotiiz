                    <div class="card-body mt-1">
                        <h4 class="mb-5 text-center">Regístrese en Cotiz</h4>
                        <form id="formAuthentication" class="mb-5 needs-validation row" method="POST" action="{{ route('register.store.users') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <h6>1. Información de la Empresa</h6>

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
                                    id="name_fantasy" name="name_fantasy" value="{{ old('name_fantasy', $rfc) }}" readonly  />
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
                                    <input type="text"
                                    class="form-control @if($errors->has('firstname')) is-invalid @endif"
                                    id="firstname" name="firstname" value="{{ old('firstname') }}"  />
                                    <label for="firstname">Primer Nombre</label>
                                    @if($errors->has('firstname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('firstname') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('second_name')) is-invalid @endif"
                                    id="second_name" name="second_name" value="{{ old('second_name') }}"  />
                                    <label for="second_name">Segundo Nombre</label>
                                    @if($errors->has('second_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('lastname')) is-invalid @endif"
                                    id="lastname" name="lastname" value="{{ old('lastname') }}"  />
                                    <label for="lastname">Apellido Paterno</label>
                                    @if($errors->has('lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('lastname') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('second_lastname')) is-invalid @endif"
                                    id="second_lastname" name="second_lastname" value="{{ old('second_lastname') }}"  />
                                    <label for="second_lastname">Apellido Materno</label>
                                    @if($errors->has('second_lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_lastname') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_gafete')) is-invalid @endif"
                                    id="file_gafete" name="file_gafete"  />
                                    <label for="file_gafete">Foto de gafete lado #1 </label>
                                    @if($errors->has('file_gafete'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_gafete') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_gafete2')) is-invalid @endif"
                                    id="file_gafete2" name="file_gafete2"  />
                                    <label for="file_gafete2">Foto de gafete lado #2 </label>
                                    @if($errors->has('file_gafete2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_gafete2') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_credential')) is-invalid @endif"
                                    id="file_credential" name="file_credential"  />
                                    <label for="file_credential">Foto credencial de elector (INE) lado #1 </label>
                                    @if($errors->has('file_credential'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_credential') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_credential2')) is-invalid @endif"
                                    id="file_credential2" name="file_credential2"  />
                                    <label for="file_credential2">Foto credencial de elector (INE) lado #2 </label>
                                    @if($errors->has('file_credential2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_credential2') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('workstation')) is-invalid @endif"
                                    id="workstation" name="workstation"  value="{{ old('workstation') }}" />
                                    <label for="workstation">Puesto que desempeña en la empresa </label>
                                    @if($errors->has('workstation'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('workstation') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('area_work')) is-invalid @endif"
                                    id="area_work" name="area_work"  value="{{ old('area_work') }}" />
                                    <label for="area_work">Área en la que se encuentra </label>
                                    @if($errors->has('area_work'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('area_work') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('phone')) is-invalid @endif"
                                    id="phone" name="phone"  value="{{ old('phone') }}" />
                                    <label for="phone">Teléfono de la empresa / extensión </label>
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('phone_personal')) is-invalid @endif"
                                    id="phone_personal" name="phone_personal"  value="{{ old('phone_personal') }}" />
                                    <label for="phone_personal">Teléfono personal </label>
                                    @if($errors->has('phone_personal'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone_personal') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <h6>2. Información de Direccion de Empresa</h6>
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

                            <hr class="my-6 mx-n4">
                            <h6>3. Información de Usuario</h6>
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
