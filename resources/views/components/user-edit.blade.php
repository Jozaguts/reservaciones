
<div class="container-fluid d-none" id="userEditModal">
    <span class="close-modal-edit" id="closeModalEdit"></span>
    <div class="row justify-content-center row-modal">
        <div class="col-md-6 modal-content">
            <div class="card">
                <div class="header-modal-container">
                    <div class="card-header" id="card-header">{{ __('Editar Usuario') }} <span class="text-capitalize font-weight-bold" id="userNametitle"> </span></div>
                    
                </div>
                <div class="card-body">
                    <form method="PUT" action="{{url ('usuarios') }}">
                         {{-- @csrf --}}
                        @method('PUT')
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de usuario') }}<br> <small id="helpId" class="text-muted">(Correo electrónico)</small>
                            </label>

                            <div class="col-md-6">
                                <input id="editEmail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" autofocus >
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
                                <input id="editFirst_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="" >

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
                                <input id="editLast_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="" >

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
                                <input id="editPassword" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Perfil') }}</label>

                            <div class="col-md-6">
                                <select name="role" id="editRole" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} text-capitalize" >

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
                                <input id="editDepartment" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="" >

                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ __('Desactivar') }}</label>

                            <div class="col-md-6 ">
                                <input id="editActive" type="checkbox" class="align-self-start form-control{{ $errors->has('active') ? ' is-invalid' : '' }}" name="active" value="">

                                @if ($errors->has('active'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('active') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="userId" id="userId" value="">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 main-nav">
                                <a href="#!" class="btn main-navbar" id="btnEdit"> {{ __('Actualizar Usuario') }}</a>
                            {{-- <button type="submit" class="btn main-navbar" id="btnEdit"> --}}
                                   
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>