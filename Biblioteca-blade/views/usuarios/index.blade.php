@extends('layouts.plantilla-a')
@section('funciones')
<?php
    if (isset($_SESSION["mensajes"])) {
        echo '<div class="alert alert-text-dark alert-dismissible fade show" role="alert" aria-label="close">';
        echo $_SESSION["mensajes"];
        echo '</div>';

        unset($_SESSION["mensajes"]);
    }
?>
@endsection
@section('contenido')
<h1>Usuarios</h1>
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
        <th class="table-text-dark">Email</th>
        <th class="table-text-dark">Contraseña</th>
        <th class="table-text-dark">Tipo</th>
        <th class="table-text-dark">¿Puede alquilar?</th>
        <th class="table-text-dark">Fecha de creación</th>
        <th class="table-text-dark">Fecha de modificación</th>
        <th colspan="2" class="table-text-dark">Opciones</th>
    </tr>
@foreach($usuarios as $clave => $valor)
    <tr>
       <td>{{$valor['id']}}</td>
       <td>{{$valor['first_name']}}</td>
       <td>{{$valor['last_name']}}</td>
       <td>{{$valor['email']}}</td>
       <td>{{$valor['password']}}</td>
       <td>{{$valor['tipo']}}</td>
       <td><?= $valor['activo'] ? 'No' : 'Si'; ?></td>
       <td>{{$valor['created_at']}}</td>
       <td>{{$valor['updated_at']}}</td>

       <!-- Se utilizará más adelante para indicar si se quiere modificar o eliminar el registro -->
       <td><a class="btn btn-warning btn-sm" href="modificar.php?id={{$valor['id']}}">
               <i class="fa fa-pencil" aria-hidden="true"></i>
           </a>
       </td>
       <td>
           <a class="btn btn-danger btn-sm" onClick="return confirm('¿Desea borrar el usuario?')" href="borrar.php?id={{$valor['id']}}">
               <i class="fa fa-trash" aria-hidden="true"></i>
           </a>
       </td>
    </tr>
@endforeach
</table>
<a class="btn btn-info btn-sm" href="../index.php">Volver al índice</a>
@endsection