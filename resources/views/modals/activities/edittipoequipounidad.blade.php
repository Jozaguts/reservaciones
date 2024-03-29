

<div class="container-fluid d-none" id="tipoEUEditModal">
       
            <div class="row justify-content-center row-modal">
                <div class="col-sm-8 col-md-6 modal-content">
                    <div class="card">
                        <div class="header-modal-container">
                               
                        <div class="card-header" id="card-header">{{ __('Editar Equipo/Unidad') }} </div>
                        <span class="close-modal-edit " id="closeModalEdit"></span>
                        @if ($errors->any())
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 offset-md-2">
                                    <div class="alert alert-danger float-right">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        @endif
                        </div>
                        <div class="card-body">
                            <form method="PUT" action="{{ url('tipounidades') }}" id="tipoEUForm">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                @method('PUT')
        
                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}
                                    </label>
                                       
                                    <div class="col-md-6">
                                        <input id="editNombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre"  autofocus>
                                        @if ($errors->has('nombre'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="combustible" class="col-md-4 col-form-label text-md-right">{{ __('Combustible') }} <br>    
                                        </label>
                                    
                                    <div class="col-md-6">
                                        <input id="editCombustible" type="text" class="form-control{{ $errors->has('combustible') ? ' is-invalid' : '' }}" name="combustible" value="{{ old('combustible') }}"  >
        
                                        @if ($errors->has('combustible'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('combustible') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="medio" class="col-md-4 col-form-label text-md-right">{{ __('Medio') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="editMedio" type="text" class="form-control{{ $errors->has('medio') ? ' is-invalid' : '' }}" name="medio" value="{{ old('medio') }}"  >
            
                                            @if ($errors->has('medio'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('medio') }}</strong>
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
                                {{-- <input type="hidden" name="editRemoved" value=0> --}}
                                <input type="hidden" name="editIdUsuario" value={{Auth::user()->id}} id="editIdUsuario">
                                <input type="hidden" name="editId" value="" id="editId">
                                <input type="hidden" name="editRemove" value="" id="editRemove">
                     
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4 main-nav">
                                            <a href="#!" class="btn main-navbar" id="btnEdit"> {{ __('Editar') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>