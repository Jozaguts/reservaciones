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
$(document).ready(function() {
    $('#asignaciones').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ Resultados",
            "sSearch": "Buscar:",
            "zeroRecords": "Nothing found - sorry",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        }
        
    });
} );
</script>



@endsection