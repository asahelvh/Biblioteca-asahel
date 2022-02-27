@extends('layouts.plantilla')
@section('contenido')
<a id="inicio"></a>
    <header class="container-fluid container-sm">
        <div class="container-fluid">
            <h1 class="titulo">PANEL DE CONTROL</h1>
        </div>
    </header>
    <br/>
    <div>
<section id="informacion">
    <div class="container border border-light">
      <h2> USUARIO: </h2>
      <h5>Nombre: <?= $_SESSION["first_name"]?></h5>
      <h5>Apellidos: <?= $_SESSION["last_name"]?></h5>
      <h5>Email: <?= $_SESSION["email"]?></h5>
      <form method="post">
        <a class="btn btn-info btn-sm" href="mod_usuarios.php?id={{$_SESSION['id']}}">
          MODIFICAR
        </a>
      </form>
    </div>
    <div class="container border border-light">
      <h2> CONTRASEÑA: </h2>
      <form method="post">
        <h5><a class="btn btn-info btn-sm" href="mod_contra.php?id={{$_SESSION['id']}}">
          MODIFICAR CONTRASEÑA
        </a></h5>
      </form>
    </div>
    <div class="container border border-light">
      <h2> PRÉSTAMOS: </h2>
      @if (!empty($prestamos))
      <div class="row">
        @foreach ($prestamos as $key => $value)
        <div class="justify-content-start col-md-3">
          <img src="imagenes/{{$value['foto']}}">
        </div>
        <div class="justify-content-start col-md-8">
          <ul>
            <li>Libro: {{$value['libro']}}</li>
            <li>Fecha del prestamo: {{$value['fecha_prestamo']}}</li>
            <li>Fecha de la devolución: {{$value['fecha_devolucion']}}</li>
            @if ($value['dif'] > 0)
            <li>Días Restantes: {{$value['dif']}}</li>
            @else
            <li>Días de retraso: {{$value['dif']*-1}}</li>     
            @endif
          </ul>
        </div>
        @endforeach
      </div>
      @else
        <h5> No hay prestamos activos </h5>
      @endif
    </div>
    <div class="container border border-light">
      <h2> SANCIONES: </h2>
      @if (!empty($sanciones))
        @foreach ($sanciones as $key => $value)
        <div class="justify-content-start bg-dark">
          <ul>
            <li>Sanción: NO PUEDE ALQUILAR MÁS LIBROS</li>
            <li>Motivo: {{$value['motivo']}}</li>
            <li>Acaba el: {{$value["dias"]}}</li>
          @endforeach
          </ul>
        </div>  
      </div>
      @else
        <h5> No hay sanciones activas 😁</h5>
      @endif
    </div>
</section>
  <br/>
  <h5><a class="btn btn-info btn-sm" href="index.php">
    Volver al incio
  </a></h5>
</div>
@endsection