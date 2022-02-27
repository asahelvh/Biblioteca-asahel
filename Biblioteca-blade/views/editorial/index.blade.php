@extends('layouts.plantilla-a')
@section('contenido')
<h1>Editoriales</h1>
<div class="d-flex justify-content-between mb-2">
    <form action="index.php" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="buscar">
            <button class="btn btn-danger" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>

    <a class="btn btn-success btn-sm" href="nuevo.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear</a>

</div>


<table class="table table-striped table-bordered">
    <tr>
        <th class="table-danger">Código</th>
        <th class="table-danger">Nombre</th>
        <th class="table-danger">Fecha de creación</th>
        <th class="table-danger">Fecha de modificación</th>
        <th colspan="2" class="table-danger">Opciones</th>
    </tr>
@foreach ($editorial as $clave => $valor)
    <tr>
       <td>{{$valor['id']}}</td>
       <td>{{$valor['nombre']}}</td>
       <td>{{$valor['fecha_creacion']}}</td>
       <td>{{$valor['fecha_modificacion']}}</td>

       <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
       <td><a class="btn btn-warning btn-sm" href="modificar.php?id={{$valor['id']}}">
               <i class="fa fa-pencil" aria-hidden="true"></i>
           </a>
       </td>
       <td>
           <a class="btn btn-danger btn-sm" onClick="return confirm('¿Desea borrar la editorial?')" href="borrar.php?id={{$valor['id']}}">
               <i class="fa fa-trash" aria-hidden="true"></i>
           </a>
       </td>
    </tr>
@endforeach
</table>
<a class="btn btn-info btn-sm" href="../index.php">Volver al índice</a>
@endsection