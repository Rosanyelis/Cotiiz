@extends('layouts.guest')
@section('title', 'Cambiar Contraseña')
@section('content')
                <div class="card-body">
                        <h4 class="mb-4">Cambiar Contraseña 🔒</h4>
                        <form id="formAuthentication" class="mb-5" action="{{ route('password.store') }}"
                            method="POST">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-floating form-floating-outline mb-5">
                                <input
                                    type="text"
                                    class="form-control @if($errors->has('email')) is-invalid @endif"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $request->email)}}"/>
                                <label for="email">Correo</label>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-5 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="password"
                                            id="password"
                                            class="form-control @if($errors->has('password')) is-invalid @endif"
                                            name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <label for="password">Contraseña</label>
                                        @if($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                </div>
                            </div>
                            <div class="mb-5 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            type="password"
                                            id="confirm-password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <label for="confirm-password">Confirmar Contraseña</label>
                                        @if($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password_confirmation') }}
                                            </div>
                                        @endif
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100 mb-5">{{ __('Reset Password') }}</button>
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                                    <i class="ri-arrow-left-s-line scaleX-n1-rtl ri-20px me-1_5"></i>
                                    Regresar al Inicio de Sesión
                                </a>
                            </div>
                        </form>
                    </div>

@endsection

