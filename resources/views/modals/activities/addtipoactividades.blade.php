

<div class="container-fluid d-none" id="modalAddTipoActidades">
    <span class="close-modal col-md-6 offset-6" id="closeModal"></span>
   
        <div class="row justify-content-center row-modal">
            <div class="col-sm-8 col-md-6 modal-content">
                <div class="card">
                    <div class="header-modal-container">
                            <div class="card-header" id="card-header">{{ __('Agregar Tipo de Actividad') }} </div>
                 
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-sm-6 offset-md-2">
                                
                                            @include('components.alertsintomodals')
                                
                            </div>
                        </div>
                    </div>
                        
                  
                  
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('tipoactividades') }}" id="AddTipoActividadesForm">
                            <meta name="csrf-token" content="{{ csrf_token() }}" id="_token">
                            {{-- @method('PUT') --}}
                           
                          
                            <div class="form-group row">
                                <label for="clave" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}
                                </label>
                                   
                                <div class="col-md-6">
                                    <input id="clave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave"  required autofocus>
                                    @if ($errors->has('clave'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('clave') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}
                                </label>
                                   
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre"  required autofocus>
                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                                <div class="form-group row">
                                        <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="color" type="text" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" name="color" value="{{ old('color') }}" required >
            
                                            @if ($errors->has('color'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('color') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                              
                            <input type="hidden" name="active" value=1>
                            <input type="hidden" name="removed" value=0>
                            <input type="hidden" name="idusuario" value={{Auth::user()->id}}>
                 
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 main-nav">
                                    <button type="submit" class="btn main-navbar">
                                        {{ __('Agregar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>