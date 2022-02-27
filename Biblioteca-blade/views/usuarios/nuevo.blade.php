@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form action="" method="post">
        <p>
            <label for="first_name">Nombre</label>
            <input id="first_name" type="text" name="first_name">
        </p>
        <p>
            <label for="last_name">Apellidos</label>
            <input id="last_name" type="text" name="last_name">
        </p>
        <p>
            <label for="email">Email</label>
            <input id="email" type="text" name="email">
        </p>
        <p>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password">
        </p>
        <p>
            <div>Tipo</div>
            <input id="alumno" type="radio" name="tipo" value="alumno"> <label for="alumno">Alumno</label>
            <input id="bibliotecario" type="radio" name="tipo" value="bibliotecario"> <label for="bibliotecario">Bibliotecario</label>
        </p>
        <p>
            <div>¿Puede alquilar?</div>
            <input id="No-activo" type="radio" name="activo" value="1"> <label for="No-activo">No</label>
            <input id="si-activo" type="radio" name="activo" value="0"> <label for="si-activo">Si</label>
        </p>
        <p>
            <input type="submit" value="Guardar">
        </p>
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>
@endsection