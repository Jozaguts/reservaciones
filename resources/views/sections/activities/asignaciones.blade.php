@extends('layouts.app')
@section('title')
   Actividades
@endsection
@section('css')

     <link href="{{ asset('css/hamburger-menu.css') }}" rel="stylesheet">
     <link href="{{ asset('css/activities.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/asignaciones.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
     
@endsection

{{-- Contenido --}}

@section('content')
{{-- comienza el contenedor grid 20 x 80 vw --}}
<div class="container-fluid grid-contanier">
    @include('components.hamburger-menu')
    @include('contents.activities.asignaciones')    
    @include('modals.activities.asignaciones')       
</div>
{{-- finaliza el contenedor grid --}}
@endsection

@section('scripts')


<script src="{{ asset('js/datatables.js') }}" ></script> 
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" ></script> 
<script src="{{ asset('js/asignaciones.js') }}" defer></script>
<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>
<script>
 
    



 function getdataDataTables() {
    $('#asignaciones').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 20,
        ajax: '{!! url('asignaciones-get') !!}',
        columns: [
            { data: 'clave', name: 'clave' },
            { data: 'unidad', name: 'unidad' },
            { data: 'nombre', name: 'tipo_unidad' },
            { data: 'capacidad', name: 'capacidad' },
            { data: 'status', name: 'status' },
            { data: null,  render: function ( data, type, row ) {
                return "<a href='{{ url('asignaciones.show') }}/"+ data.id +"' class='btn btn-xs btn-primary'id="+ data.id +" onclick='asignacionesInfo(this);'  data-toggle='modal' data-target='.modal'>Asignar </button>" }  
            }

        ]
    });
}
getdataDataTables();

</script>



@endsection