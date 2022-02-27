@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="titulo">Titulo</label>
            <input id="titulo" type="text" name="titulo" value="{{$libros['titulo']}}">
        </p>
        <p>
            <div>¿Disponible?</div>
            <input id="si-disponible" type="radio" name="disponible" value="1"<?= $libros['disponible'] ? ' checked' : '' ?>> <label for="si-disponible">Si</label>
            <input id="no-disponible" type="radio" name="disponible" value="0"<?= !$libros['disponible'] ? ' checked' : '' ?>> <label for="no-disponible">No</label>
        </p>
        <p>

            <select name="autor_id" id="autor_id" class="form-control">
                <option value="">Seleccione un autor</option>
                @foreach ($autor as $au)
                    <option value="{{$au["id"]}}">{{$au["nombre"]}}</option>
                @endforeach
            </select>
            
        </p>
        <p>

            <select name="editorial_id" id="editorial_id" class="form-control">
                <option value="">Seleccione una editorial</option>
                @foreach ($editorial as $ed)
                    <option value="{{$ed["id"]}}">{{$ed["nombre"]}}</option>
                @endforeach
            </select>
            
        </p>
        <p>

            <select name="categoria_id" id="categoria_id" class="form-control">
                <option value="">Seleccione una categoria</option>
                @foreach ($categorias as $cat)
                    <option value="{{$cat["id"]}}">{{$cat["nombre"]}}</option>
                @endforeach
            </select>
            
        </p>
        <p>
            <div>
            <h5>Foto de perfil: <img src="../../imagenes/{{$libros['foto']}}"><br><input class="form-control" id="foto" name="foto" type="file"/></h5>
            <input type="hidden" name="imagen_vieja" value="{{$libros['foto']}}">
            </div>
        <p>
        <p>
            <input type="hidden" name="id" value="{{$id}}">
            <input type="submit" value="Modificar">
        </p>
    </form>
    <a class="link-warning" href="index.php"><i class="fas fa-home"></i></a>

@endsection