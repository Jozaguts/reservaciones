

<div class="container-fluid d-none" id="tipoEUModal">
    <span class="close-modal col-md-6 offset-6" id="closeModal"></span>
   
        <div class="row justify-content-center row-modal">
            <div class="col-sm-8 col-md-6 modal-content">
                <div class="card">
                    <div class="header-modal-container">
                            <div class="card-header" id="card-header">{{ __('Agregar Equipo/Unidad') }} </div>
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
                        <form method="POST" action="{{ url('tipounidades') }}" id="tipoEUForm">
                            <meta name="csrf-token" content="{{ csrf_token() }}" id="_token">
                            {{-- @method('PUT') --}}
    
                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}
                                </label>
                                   
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre"  required autofocus>
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
                                    <input id="combustible" type="text" class="form-control{{ $errors->has('combustible') ? ' is-invalid' : '' }}" name="combustible" value="{{ old('combustible') }}" required >
    
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
                                        <input id="medio" type="text" class="form-control{{ $errors->has('medio') ? ' is-invalid' : '' }}" name="medio" value="{{ old('medio') }}" required >
        
                                        @if ($errors->has('medio'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medio') }}</strong>
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