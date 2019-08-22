<div class="container-asiginaciones">
    <table id="asignaciones">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Unidad</th>
                <th>Tipo Unidad</th>
                <th>Capacidad</th>
                <th>Activo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unidades as $unidad)
            <tr>
            <td>{{$unidad->clave}}</td>
            <td>{{$unidad->tipounidad->nombre}}</td>
            <td>{{$unidad->tipounidad->medio}}</td>
            <td>{{$unidad->capacidad}}</td>
            <td><?php if($unidad->active =="1"){
                echo "Activado";
                }else{
                    echo "No Activado"; 
                }
                ?>
                
             </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
