@extends('layouts.app')
@section('title', 'Profesional - Crear')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Nuevo Profesional</h5>

                    <a href="{{ route('professional.index') }}" class="btn btn-sm btn-secondary"><i
                            class="ri-arrow-left-line me-1"></i> Regresar</a>
                </div>
                <form class="needs-validation" action=" {{ route('professional.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-6">
                            <img src="{{asset('assets/img/products/no-photo.jpg')}}" alt="user-avatar"
                                class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Cargar imagen de Profesional (opcional)</span>
                                    <i class="ri-upload-2-line d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input @if($errors->has('photo')) is-invalid @endif" hidden
                                        accept="image/png, image/jpeg" name="photo" />
                                </label>
                                <button type="button" class="btn btn-outline-danger account-image-reset mb-4">
                                    <i class="ri-refresh-line d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <div>JPG, GIF o PNG permitidos. Tamaño máximo de 800K</div>
                            </div>
                            @if($errors->has('file_photo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file_photo') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="firstname"
                                        class="form-control @if($errors->has('firstname')) is-invalid @endif"
                                        placeholder="Ingrese primer nombre de Profesional"
                                        value="{{ old('firstname') }}" />
                                    <label for="code">Primer Nombre</label>
                                    @if($errors->has('firstname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('firstname') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="second_name"
                                        class="form-control @if($errors->has('second_name')) is-invalid @endif"
                                        placeholder="Ingrese segundo nombre de Profesional"
                                        value="{{ old('second_name') }}" />
                                    <label for="code">Segundo Nombre</label>
                                    @if($errors->has('second_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="lastname"
                                        class="form-control @if($errors->has('lastname')) is-invalid @endif"
                                        placeholder="Ingrese primer apellido de Profesional"
                                        value="{{ old('lastname') }}" />
                                    <label for="code">Primer Apellido</label>
                                    @if($errors->has('lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('lastname') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="second_lastname"
                                        class="form-control @if($errors->has('second_lastname')) is-invalid @endif"
                                        placeholder="Ingrese segundo apellido de Profesional"
                                        value="{{ old('second_lastname') }}" />
                                    <label for="code">Segundo Apellido</label>
                                    @if($errors->has('second_lastname'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('second_lastname') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="name" name="phone"
                                        class="form-control @if($errors->has('phone')) is-invalid @endif"
                                        placeholder="Ingrese telefono de Profesional"
                                        value="{{ old('phone') }}" />
                                    <label for="code">Teléfono</label>
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" id="email" name="email"
                                        class="form-control @if($errors->has('email')) is-invalid @endif"
                                        placeholder="Ingrese correo de Profesional"
                                        value="{{ old('email') }}" />
                                    <label for="code">Correo</label>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('country')) is-invalid @endif"
                                    id="country" name="country" value="{{ old('country') }}"
                                    placeholder="Ingrese pais de Profesional"/>
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
                                    id="state" name="state"  value="{{ old('state') }}"
                                    placeholder="Ingrese estado de Profesional" />
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
                                    class="form-control @if($errors->has('city')) is-invalid @endif"
                                    id="city" name="city"  value="{{ old('city') }}"
                                    placeholder="Ingrese la Ciudad de Profesional" />
                                    <label for="city">Ciudad</label>
                                    @if($errors->has('city'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('address')) is-invalid @endif"
                                    id="address" name="address"  value="{{ old('address') }}"
                                    placeholder="Ingrese la Dirección de Profesional" />
                                    <label for="address">Dirección</label>
                                    @if($errors->has('address'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('zip')) is-invalid @endif"
                                    id="zip" name="zip"  value="{{ old('zip') }}"
                                    placeholder="Ingrese la  Código Postal de Profesional" />
                                    <label for="zip">Codigo Postal</label>
                                    @if($errors->has('zip'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('zip') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <select id="occupation_id" name="occupation_id" class="form-select select2"
                                    placeholder="Selecione la Profesión">
                                        <option value="0">-- Seleccionar --</option>
                                        @foreach ($profesions as $item)
                                        <option value="{{ $item->id }}" {{ old('occupation_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="code">Profesion</label>
                                    @if($errors->has('occupation_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('occupation_id') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-6 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <select id="specialty_id" name="specialty_id" class="form-select select2"
                                    placeholder="Selecione la Especialidad">
                                        <option value="">-- Seleccionar --</option>
                                        @foreach ($specialties as $item)
                                        <option value="{{ $item->id }}" {{ old('specialty_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="code">Especialidad</label>
                                    @if($errors->has('specialty_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('specialty_id') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_cv')) is-invalid @endif"
                                    id="file_cv" name="file_cv"  />
                                    <label for="file_cv">CV actualizado a color</label>
                                    @if($errors->has('file_cv'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_cv') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_title_trainee_1')) is-invalid @endif"
                                    id="file_title_trainee_1" name="file_title_trainee_1"  />
                                    <label for="file_title_trainee_1">Titulo o Carta pasante a color lado #1</label>
                                    @if($errors->has('file_title_trainee_1'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_title_trainee_1') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_title_trainee_2')) is-invalid @endif"
                                    id="file_title_trainee_2" name="file_title_trainee_2"  />
                                    <label for="file_title_trainee_2">Titulo o Carta pasante a color lado #2</label>
                                    @if($errors->has('file_title_trainee_2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_title_trainee_2') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_voter_idcard_1')) is-invalid @endif"
                                    id="file_voter_idcard_1" name="file_voter_idcard_1"  />
                                    <label for="file_voter_idcard_1">Foto credencial de elector (INE) lado #1</label>
                                    @if($errors->has('file_voter_idcard_1'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_voter_idcard_1') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="file"
                                    class="form-control @if($errors->has('file_voter_idcard_2')) is-invalid @endif"
                                    id="file_voter_idcard_2" name="file_voter_idcard_2"  />
                                    <label for="file_voter_idcard_2">Foto credencial de elector (INE) lado #2</label>
                                    @if($errors->has('file_voter_idcard_2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('file_voter_idcard_2') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('facebook')) is-invalid @endif"
                                    id="facebook" name="facebook"  value="{{ old('facebook') }}"
                                    placeholder="Ingrese la Url de Facebook" />
                                    <label for="facebook">Facebook</label>
                                    @if($errors->has('facebook'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('facebook') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('instagram')) is-invalid @endif"
                                    id="instagram" name="instagram"  value="{{ old('instagram') }}"
                                    placeholder="Ingrese la Url de instagram" />
                                    <label for="instagram">Instagram</label>
                                    @if($errors->has('instagram'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('instagram') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('twitter')) is-invalid @endif"
                                    id="twitter" name="twitter"  value="{{ old('twitter') }}"
                                    placeholder="Ingrese la Url de twitter" />
                                    <label for="twitter">Twitter</label>
                                    @if($errors->has('twitter'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('twitter') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input type="text"
                                    class="form-control @if($errors->has('linkedin')) is-invalid @endif"
                                    id="linkedin" name="linkedin"  value="{{ old('linkedin') }}"
                                    placeholder="Ingrese la Url de linkedin" />
                                    <label for="linkedin">Linkedin</label>
                                    @if($errors->has('linkedin'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('linkedin') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="mb-6 col-md-1">
                                <button type="submit" class="btn btn-primary float-end">
                                    <i class="ri-save-2-line me-1"></i>
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- Page JS -->
<script>
    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
</script>
<script src="{{ asset('pagesjs/product.js') }}"></script>
@endsection
