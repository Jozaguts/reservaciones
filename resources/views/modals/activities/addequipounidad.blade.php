

<div class="container-fluid d-none" id="modalAddEU">
        
       
            <div class="row justify-content-center row-modal">
                <div class="col-sm-8 col-md-6 modal-content">
                    <div class="card">
                        <div class="header-modal-container">
                                <div class="card-header" id="card-header">{{ __('Agregar Equipo/Unidad') }}  </div>
                     
                   
                            
                        <span class="close-modal " id="closeModal"></span>
                      
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('tipounidades') }}" id="eUForm">
                                <div class="container mt-3">
                                    <div class="row">
                                        <div class="col-sm-6 offset-md-2">
                                            
                                                        @include('components.alertsintomodals')
                                            
                                        </div>
                                    </div>
                                </div>
                                <meta name="csrf-token" content="{{ csrf_token() }}" id="_token">
                                {{-- @method('PUT') --}}
                               
                              
                                <div class="form-group row">
                                    <label for="clave" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}
                                    </label>
                                       
                                    <div class="col-md-6">
                                        <input id="clave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave"  required autofocus equired autofocus size="5" maxlength="5" 
                                        style="text-transform:uppercase">
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
                                        <textarea id="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" required  rows="3"></textarea>
        
                                        @if ($errors->has('descripcion'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('descripcion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                        <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }} <br>    
                                            </label>
                                       
                                        <div class="col-md-6">
                                            <input type="text" id="placa" class="form-control{{ $errors->has('placa') ? ' is-invalid' : '' }}" name="placa" value="{{ old('placa') }}" required >
            
                                            @if ($errors->has('placa'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('placa') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    {{-- {{dd($unidades[0]->tipounidad)}} --}}
                                    <div class="form-group row">
                                            <label for="idtipounidad" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Unidad') }}</label>
                                          
                                            <div class="col-md-6">
                                                <select name="idtipounidad" id="idTipoUnidad" class="form-control{{ $errors->has('idtipounidad') ? ' is-invalid' : '' }} text-capitalize" required>
                                                    @forelse ($tipounidades as $tipounidad)
                                                    <option  value="{{$tipounidad->id}}">{{$tipounidad->nombre}}</option>
                                                    @empty
                                                        
                                                    @endforelse
                                                    
                                                </select>
                                                @if ($errors->has('idtipodeunidad'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('idtipodeunidad') }}</strong>
                                                    </span>
                                                @endif
                                            </div>                          
                                        </div>

                          
                                <div class="form-group row">
                                        <label for="capacidad" class="col-md-4 col-form-label text-md-right">{{ __('Capacidad') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="capacidad" type="number" class="form-control{{ $errors->has('capacidad') ? ' is-invalid' : '' }}" name="capacidad" value="{{ old('capacidad') }}" required >
            
                                            @if ($errors->has('capacidad'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('capacidad') }}</strong>
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


                                        <div class="form-group row">
                                        <label for="horario" class="col-md-4 col-form-label text-md-right">{{__('Horario')}}</label>
                                        <div class="col-md-6">
                                                <table >
                                                        <thead>
                                                            <tr>
                                                                <th class="table-head" >Día</th>
                                                                <th class="table-head" >Inicio</th>
                                                                <th class="table-head" >Fín</th>
                                                            </tr>
                                                        </thead>
                                                   
                                                        <tbody >
                                                       
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" name="todoslosdias" id="todosLosDias"  value="todoslosdias">
                                                                 </td>
        
                                                                 <td>
                                                                     <input type="time" name="iniciotodoslosdias" id="inicioTodosLosDias" class="form-control">
                                                                 </td>
                                                                 <td>
                                                                        <input type="time" name="fintodoslosdias" id="finTodosLosDias" class="form-control">
                                                                    </td>
                                                            </tr>
                                                            @foreach ($dias as $dia)
                                                            <tr>
                                                                    <td class="display-flexbox">
                                                                    <input type="checkbox" name="{{$dia->dia}}" id="{{$dia->dia}}"  value="{{$dia->dia}}" class="day" onchange="habilitarInput(this)" ><span class="day-span">{{$dia->dia}}</span>
                                                                     </td>
            
                                                                     <td >
                                                                     <input type="time" name="inicio{{$dia->dia}}" id="inicio{{$dia->dia}}" class="form-control input-time" disabled >
                                                                     </td>
                                                                     <td >
                                                                            <input type="time" name="fin{{$dia->dia}}" id="fin{{$dia->dia}}" class="form-control input-time" disabled>
                                                                        </td>
                                                            </tr>
                                                                
                                                            @endforeach
                                                        </tbody>
                                                    </table>
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