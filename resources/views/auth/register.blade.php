@extends('layouts.app')
@section('css')

@hasrole('administrador')
<link rel="stylesheet" href="{{asset('css/login-resposive.css')}}">
@endsection
@section('content')

    <div class="card-body col-md-8 my-auto mx-auto" >
        <form method="POST" action="{{ url('register') }}" >{{-- @method('PUT'); --}}  @csrf
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de usuario') }}<br> <small id="helpId" class="text-muted">(Correo electrónico)</small>
                </label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }} <br></label>
                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
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
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
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
                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                    <div class="col-md-6">
                        <select name="role" id="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" required autofocus>
                            <option  value=""></option>
                            <option  value="opera">Operador</option>
                            <option value="super" >Supervisor</option>
                            <option value="admin">Administrador</option>
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
                    <input id="department" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" required autofocus>
                        @if ($errors->has('department'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('department') }}</strong>
                        </span>
                        @endif
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-md-3 offset-md-4 main-nav">
                    <button type="submit" class="btn main-navbar btn-block">{{ __('Registrar') }}</button>
                </div>
            </div>
        </form>
</div>
<script src="{{asset("js/all.js")}}"></script>
@else
    <h5>Solo administradores tiene acceso</h5>
@endhasrole
@endsection
