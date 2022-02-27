@extends('layouts.plantilla-a')
@section('contenido')
<h1>Libros</h1>
<div class="d-flex justify-content-between mb-2">
    <form action="index.php" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="buscar">
            <button class="btn btn-warning" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>

    <a class="btn btn-success btn-sm" href="nuevo.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear</a>

</div>


<table class="table table-striped table-bordered">
    <tr>
        <th class="table-warning">Código</th>
        <th class="table-warning">Título</th>
        <th class="table-warning">¿Disponible?</th>
        <th class="table-warning">Autor</th>
        <th class="table-warning">Categoria</th>
        <th class="table-warning">Editorial</th>
        <th class="table-warning">Foto</th>
        <th colspan="2" class="table-warning">Opciones</th>
    </tr>
@foreach($libros as $clave => $valor)
    <tr>
       <td>{{$valor['id']}}</td>
       <td>{{$valor['titulo']}}</td>
       <td><?= $valor['disponible'] ? 'Si' : 'No'; ?></td>
       <td>{{$valor['au']}}</td>
       <td>{{$valor['cat']}}</td>
       <td>{{$valor['ed']}}</td>
       <td><img src="../../imagenes/{{$valor['foto']}}"></td>

       <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
       <td><a class="btn btn-warning btn-sm" href="modificar.php?id={{$valor['id']}}">
               <i class="fa fa-pencil" aria-hidden="true"></i>
           </a>
       </td>
       <td>
           <a class="btn btn-danger btn-sm" onClick="return confirm('¿Desea borrar el libro?')" href="borrar.php?id={{$valor['id']}}">
               <i class="fa fa-trash" aria-hidden="true"></i>
           </a>
       </td>
    </tr>
@endforeach
</table>
<a class="btn btn-info btn-sm" href="../index.php">Volver al índice</a>
@endsection