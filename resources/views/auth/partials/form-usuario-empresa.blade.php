                    <div class="card-body mt-1">
                        <h4 class="mb-5 text-center">Regístrese en Cotiz</h4>
                        <form id="formAuthentication" class="mb-5 needs-validation row" method="POST" action="{{ route('register.store.users') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="rfc" value="{{ $rfc }}">
                            <input type="hidden" name="tipo" value="{{ $tipo }}">
                            <h6>1. Información de Usuario</h6>
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
