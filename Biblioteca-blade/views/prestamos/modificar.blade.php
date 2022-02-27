@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form method="post">
        <p>

            <select name="libro_id" id="libro_id" class="form-control">
                <option value="">Seleccione un libro</option>
                @foreach ($libros as $lib)
                    @if ($lib['disponible'] == 1)
                        <option value="{{$lib["id"]}}">{{$lib["titulo"]}}</option>
                    @endif
                @endforeach
            </select>
            
        </p>
        <p>

            <select name="usuario_id" id="usuario_id" class="form-control">
                <option value="">Seleccione un usuario</option>
                @foreach ($usuarios as $us)
                    <option value="{{$us["id"]}}">{{$us["email"]}}</option>
                @endforeach
            </select>
            
        </p>
        <p>
            <label for="fecha_devolucion">Fecha de devolución</label>
            <input id="fecha_devolucion" type="date" name="fecha_devolucion" value="{{$prestamos['fecha_devolucion']}}">
        </p>
        <p>
            <input type="hidden" name="id" value="{{$id}}">
            <input type="submit" value="Modificar">
        </p>
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>

@endsection