
@extends('layouts.guest')
@section('title', 'Recuperar Contraseña')
@section('content')
                    <div class="card-body">
                        <p class="mb-5 text-left">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-solid-success d-flex align-items-center mb-4" role="alert">
                                <span class="alert-icon rounded">
                                    <i class="ri-checkbox-circle-line ri-22px"></i>
                                </span>
                                {{session('status')}}
                            </div>
                        @endif
                        <form id="formAuthentication" class="mb-5" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-floating form-floating-outline mb-5">
                                <input
                                    type="text"
                                    class="form-control  @if($errors->has('email')) is-invalid @endif"
                                    id="email"
                                    name="email"
                                    value="{{old('email')}}"

                                    autofocus />
                                <label>{{ __('Email') }}</label>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <button class="btn btn-primary d-grid w-100">{{ __('Email Password Reset Link') }}</button>
                        </form>
                    </div>
@endsection

