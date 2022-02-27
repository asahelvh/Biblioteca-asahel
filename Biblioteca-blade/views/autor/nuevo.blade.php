@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre">
        </p>
        <p>
            <label for="apellidos">Apellidos</label>
            <input id="apellidos" type="text" name="apellidos">
        </p>
        <p>
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input id="fecha_nacimiento" type="date" name="fecha_nacimiento">
        </p>
        <p>
            <label for="fecha_fallecimiento">Fecha de fallecimiento</label>
            <input id="fecha_fallecimiento" type="date" name="fecha_fallecimiento">
        </p>
        <p>
            <label for="lugar_nacimiento">Lugar de nacimiento</label>
            <input id="lugar_nacimiento" type="text" name="lugar_nacimiento">
        </p>
        <p>
            <label for="biografia">Biografía</label>
            <input id="biografia" type="text" name="biografia" size="250">
        </p>
        <p>
            <div>
            <h5>Foto de perfil:<br><input class="form-control" id="foto" name="foto" type="file"/></h5>
            </div>
        <p>
        <p>
            <input type="submit" value="Guardar">
        </p>
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>
@endsection