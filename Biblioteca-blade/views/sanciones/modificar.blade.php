@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form method="post">
        <p>
            <select name="usuario_id" id="usuario_id" class="form-control">
                <option value="">Seleccione un usuario</option>
                @foreach ($usuarios as $us)
                    <option value="{{$us["id"]}}">{{$us["email"]}}</option>
                @endforeach
            </select>
        </p>
        <p>
            <label for="motivo">Motivo</label>
            <input id="motivo" type="text" name="motivo" size="250" value="{{$sanciones['motivo']}}">
        </p>
        <p>
            <input type="hidden" name="id" value="{{$id}}">
            <input type="submit" value="Modificar">
        </p>
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>

@endsection