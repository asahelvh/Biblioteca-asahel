@extends('layouts.plantilla')
@section('contenido')
<body>
    <form action="" method="post">
        <div class="container mb-3">
        <h5>
            <label for="first_name">Nombre</label>
            <input id="first_name" type="text" name="first_name" value="{{$usuarios['first_name']}}">
        </h5>
        <h5>
            <label for="last_name">Apellidos</label>
            <input id="last_name" type="text" name="last_name" value="{{$usuarios['last_name']}}">
        </h5>
        <h5>
            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="{{$usuarios['email']}}">
        </h5>
        <h5>
            <input type="hidden" name="id" value="{{$id}}">
            <button class="btn btn-success" type="submit" value="Modificar">Modificar</button>
        </h5>
    </form>
    <a class="link-warning" href="panel_control.php"><h5 class="text-warning"> Volver al panel de control</h5></a>
@endsection