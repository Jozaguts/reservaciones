
<div class="container-fluid d-none" id="userEditModal">
    <span class="close-modal" id="closeModalEdit"></span>
    <div class="row justify-content-center row-modal">
        <div class="col-md-6 modal-content">
            <div class="card">
                <div class="header-modal-container">
                    <div class="card-header" id="card-header">{{ __('Editar Usuario') }} </div>
                    
                </div>
                <div class="card-body">
                    <form method="PUT" action="{{route ('usuarios.update','test') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de usuario') }}<br> <small id="helpId" class="text-muted">(Correo electrónico)</small>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email}}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }} <br>
                            </label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required >

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required >

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirma contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Perfil') }}</label>

                            <div class="col-md-6">
                                <select name="role" id="role" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} text-capitalize" required autofocus>

                                    @foreach ($roles as $key =>$value)
                                        <option  value="{{$value}}" class="text-capitalize">{{$value}}</option>
                                    @endforeach
                                    {{-- <option  value=""></option>
                                    <option  value="opera">Operador</option>
                                    <option value="super" id="supervisor">Supervisor</option>
                                    <option value="admin">Administrador</option> --}}
                                </select>
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Departamento') }}</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" required autofocus>

                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ __('Activo') }}</label>

                            <div class="col-md-6 ">
                                <input id="active" type="checkbox" class="align-self-start form-control{{ $errors->has('active') ? ' is-invalid' : '' }}" name="active" value="{{ old('active') }}">

                                @if ($errors->has('active'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('active') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 main-nav">
                                <button type="submit" class="btn main-navbar">
                                    {{ __('Actualizar Usuario') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>