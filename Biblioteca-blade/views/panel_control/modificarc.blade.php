@extends('layouts.plantilla')
@section('contenido')
<body>
    <form action="" method="post">
        <div class="container mb-3">
        <h5>
            <p>
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password">
            </p>
        </h5>
        <h5>
            <input type="hidden" name="id" value="{{$id}}">
            <button class="btn btn-success" type="submit" value="Modificar">Modificar</button>
        </h5>
    </form>
    <a class="link-warning" href="panel_control.php"><h5 class="text-warning"> Volver al panel de control</h5></a>
@endsection