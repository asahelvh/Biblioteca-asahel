@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form action="" method="post">
        <p>
            <label for="nombre">nombre</label>
            <input id="nombre" type="text" name="nombre">
        </p>
        <p>
            <input type="submit" value="Guardar">
        </p>
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>
@endsection