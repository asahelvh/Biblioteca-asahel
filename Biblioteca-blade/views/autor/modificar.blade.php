@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" value="{{$autor['nombre']}}">
        </p>
        <p>
            <label for="apellidos">Apellidos</label>
            <input id="apellidos" type="text" name="apellidos" value="{{$autor['apellidos']}}">
        </p>
        <p>
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" value="{{$autor['fecha_nacimiento']}}">
        </p>
        <p>
            <label for="fecha_fallecimiento">Fecha de fallecimiento</label>
            <input id="fecha_fallecimiento" type="date" name="fecha_fallecimiento" value="{{$autor['fecha_fallecimiento']}}">
        </p>
        <p>
            <label for="lugar_nacimiento">Lugar de nacimiento</label>
            <input id="lugar_nacimiento" type="text" name="lugar_nacimiento" value="{{$autor['lugar_nacimiento']}}">
        </p>
        <p>
            <label for="biografia">Biografía</label>
            <input id="biografia" type="text" name="biografia" size="250" value="{{$autor['biografia']}}">
        </p>
        <p>
            <div>
            <h5>Foto de perfil: <img src="../../imagenes/{{$autor['foto']}}"><br><input name="foto" type="file"/></h5>
            <input type="hidden" name="imagen_vieja" value="{{$autor['foto']}}">
            </div>
        <p>
        <p>
            <input type="hidden" name="id" value="{{$id}}">
            <input type="submit" value="Modificar">
        </p>
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>

@endsection