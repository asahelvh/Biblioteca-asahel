@extends('layouts.plantilla-a')
@section('contenido')
<h1>Autor</h1>
<div class="d-flex justify-content-between mb-2">
    <form action="index.php" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="buscar">
            <button class="btn btn-text-dark" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>

    <a class="btn btn-success btn-sm" href="nuevo.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear</a>

</div>


<table class="table table-striped table-bordered">
    <tr>
        <th class="table-text-dark">Código</th>
        <th class="table-text-dark">Nombre</th>
        <th class="table-text-dark">Apellidos</th>
        <th class="table-text-dark">Fecha de nacimiento</th>
        <th class="table-text-dark">Fecha de fallecimiento</th>
        <th class="table-text-dark">Lugar de nacimiento</th>
        <th class="table-text-dark">Biografía</th>
        <th class="table-text-dark">Foto</th>
        <th class="table-text-dark">Fecha de creación</th>
        <th class="table-text-dark">Fecha de modificación</th>
        <th colspan="2" class="table-text-dark">Opciones</th>
    </tr>
    
@foreach($autor as $clave => $valor)
    <tr>
       <td>{{$valor['id']}}</td>
       <td>{{$valor['nombre']}}</td>
       <td>{{$valor['apellidos']}}</td>
       <td>{{$valor['fecha_nacimiento']}}</td>
       @if ($valor['fecha_fallecimiento'] != "0000-00-00")
        <td>{{$valor['fecha_fallecimiento']}}</td>
       @else
        <td>Actualmente vivo</td>
       @endif
       <td>{{$valor['lugar_nacimiento']}}</td>
       <td>{{$valor['biografia']}}</td>
       <td><img src="../../imagenes/{{$valor['foto']}}"></td>
       <td>{{$valor['fecha_creacion']}}</td>
       <td>{{$valor['fecha_modificacion']}}</td>

       <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
       <td><a class="btn btn-warning btn-sm" href="modificar.php?id={{$valor['id']}}">
               <i class="fa fa-pencil" aria-hidden="true"></i>
           </a>
       </td>
       <td>
           <a class="btn btn-danger btn-sm" onClick="return confirm('¿Desea borrar el autor?')" href="borrar.php?id={{$valor['id']}}">
               <i class="fa fa-trash" aria-hidden="true"></i>
           </a>
       </td>
    </tr>
@endforeach
</table>
<a class="btn btn-info btn-sm" href="../index.php">Volver al índice</a>
@endsection