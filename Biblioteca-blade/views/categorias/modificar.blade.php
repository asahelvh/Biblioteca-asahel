@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form method="post">
        <p>
            <label for="nombre">nombre</label>
            <input id="nombre" type="text" name="nombre" value="{{$categorias['nombre']}}">
        </p>
        <p>
            <input type="hidden" name="codigo" value="{{$codigo}}">
            <input type="submit" value="Modificar">
        </p>
        
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>
@endsection