

<div class="container-fluid d-none" id="modalEditEquipoUnidad">
       
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
                                <label for="clave" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}
                                </label>
                                   
                                <div class="col-md-6">
                                    <input id="editClave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave"  autofocus>
                                    @if ($errors->has('clave'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('clave') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }} <br>    
                                        </label>
                                   
                                    <div class="col-md-6">
                                        <textarea id="editDescripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}"  rows="3"></textarea>
        
                                        @if ($errors->has('descripcion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('descripcion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                </div>
                            <div class="form-group row">
                                    <label for="capaciad" class="col-md-4 col-form-label text-md-right">{{ __('Capaciad') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="editCapacidad" type="text" class="form-control{{ $errors->has('capaciad') ? ' is-invalid' : '' }}" name="capaciad" value="{{ old('capaciad') }}"  >
        
                                        @if ($errors->has('capaciad'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('capaciad') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('color') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="editColor" type="text" class="form-control{{ $errors->has('capaciad') ? ' is-invalid' : '' }}" name="color" value="{{ old('color') }}"  >
            
                                            @if ($errors->has('color'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('color') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }} <br>    
                                                </label>
                                           
                                            <div class="col-md-6">
                                                <input type="text" id="editPlaca" class="form-control{{ $errors->has('placa') ? ' is-invalid' : '' }}" name="placa" value="{{ old('placa') }}" required >
                
                                                @if ($errors->has('placa'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('placa') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            
                                        </div>
                                    <div class="form-group row">
                                            <label for="idtipounidad" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Unidad') }}</label>
                                          
                                            <div class="col-md-6">
                                                <select name="idtipounidad" id="editIdTipoUnidad" class="form-control{{ $errors->has('idtipounidad') ? ' is-invalid' : '' }} text-capitalize" required>
                                                    @forelse ($tipounidades as $tipounidad)
                                                    <option  value="{{$tipounidad->id}}">{{$tipounidad->nombre}}</option>
                                                    @empty
                                                    @endforelse 
                                                </select>
                                                @if ($errors->has('idtipounidad'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('idtipounidad') }}</strong>
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