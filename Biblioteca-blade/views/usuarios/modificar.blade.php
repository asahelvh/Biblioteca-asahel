@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form method="post">
        <p>
            <label for="first_name">Nombre</label>
            <input id="first_name" type="text" name="first_name" value="{{$usuarios['first_name']}}">
        </p>
        <p>
            <label for="last_name">Apellidos</label>
            <input id="last_name" type="text" name="last_name" value="{{$usuarios['last_name']}}">
        </p>
        <p>
            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="{{$usuarios['email']}}">
        </p>
        <p>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password">
        </p>
        <p>
            <div>Tipo</div>
            <input id="alumno" type="radio" name="tipo" value="alumno"<?= $usuarios['tipo'] ? ' checked' : 'alumno' ?>> <label for="alumno">Alumno</label>
            <input id="bibliotecario" type="radio" name="tipo" value="bibliotecario"<?= $usuarios['tipo'] ? ' checked' : 'alumno' ?>> <label for="bibliotecario">Bibliotecario</label>
        </p>
        <p>
            <div>¿Puede alquilar?</div>
            <input id="no-activo" type="radio" name="activo" value="1"<?= $usuarios['activo'] ? ' checked' : '' ?>> <label for="no-activo">No</label>
            <input id="si-activo" type="radio" name="activo" value="0"<?= !$usuarios['activo'] ? ' checked' : '' ?>> <label for="si-activo">Si</label>
        </p>
        <p>
            <input type="hidden" name="id" value="{{$id}}">
            <input type="submit" value="Modificar">
        </p>
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>

@endsection