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
{{-- comienza el contenido --}}
<div class="container-fluid grid-contanier">
    @include('components.hamburger-menu')
    @include('contents.activities.asignaciones')       
</div>


{{-- finaliza el contenido --}}
@endsection

@section('scripts')


<script src="{{ asset('js/datatables.js') }}" ></script> 
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" ></script> 
{{-- <script src="{{ asset('js/test.js') }}" defer></script> --}}
<script src="{{ asset('js/hamburgerMenu.js') }}" defer></script>
<script>
 
    



 function getdataDataTables() {
    $('#asignaciones').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 20,
        ajax: '{!! url('asignaciones-get') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'clave', name: 'clave' },
            { data: 'capacidad', name: 'capacidad' },
            { data: 'active', name: 'activo' },
            { data: null,  render: function ( data, type, row ) {
                return "<a href='{{ url('asignaciones.show') }}/"+ data.id +"' class='btn btn-xs btn-primary' >Editar  <a href='{{ url('asignaciones.delete/') }}/"+ data.id +"' class='btn btn-xs btn-danger ml-1' >Eliminar </button>" }  
            }

        ]
    });
}
getdataDataTables();

</script>



@endsection