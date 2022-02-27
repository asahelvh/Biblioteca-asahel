@extends('layouts.plantilla-a')
@section('contenido')
<h1>Prestamos</h1>
<div class="d-flex justify-content-between mb-2">
    <form action="index.php" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="buscar">
            <button class="btn btn-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>

    <a class="btn btn-success btn-sm" href="nuevo.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear</a>

</div>


<table class="table table-striped table-bordered">
    <tr>
        <th class="table-success">Código</th>
        <th class="table-success">Título</th>
        <th class="table-success">Usuario</th>
        <th class="table-success">Fecha del prestamo</th>
        <th class="table-success">Fecha de devolución</th>
        <th class="table-success">Días</th>
        <th class="table-success">Fecha de Creación</th>
        <th class="table-success">Fecha de modificación</th>
        <th colspan="2" class="table-success">Opciones</th>
    </tr>
@foreach($prestamos as $clave => $valor)
    <tr>
       <td>{{$valor['id']}}</td>
       <td>{{$valor['libro']}}</td>
       <td>{{$valor['us']}}</td>
       <td>{{$valor['fecha_prestamo']}}</td>
       <td>{{$valor['fecha_devolucion']}}</td>
       @if ($valor['dif'] > 0)
        <td>Días Restantes: {{$valor['dif']}}</td>
       @else
        <td>Días de retraso: {{$valor['dif']*-1}}</td>     
       @endif
       <td>{{$valor['fecha_creacion']}}</td>
       <td>{{$valor['fecha_modificacion']}}</td>

       <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
       <td><a class="btn btn-warning btn-sm" href="modificar.php?id={{$valor['id']}}">
               <i class="fa fa-pencil" aria-hidden="true"></i>
           </a>
       </td>
       <td>
           <a class="btn btn-danger btn-sm" onClick="return confirm('¿Desea eliminar el prestamo?')" href="borrar.php?id={{$valor['id']}}">
               <i class="fa fa-trash" aria-hidden="true"></i>
           </a>
       </td>
    </tr>
@endforeach
</table>
<a class="btn btn-info btn-sm" href="../index.php">Volver al índice</a>
@endsection