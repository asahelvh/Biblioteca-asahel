@extends('layouts.plantilla')
@section('contenido')
<a id="inicio"></a>
    <header class="container-fluid container-sm">
        <div class="container-fluid">
            <h1 class="titulo">BIBLIOTECA</h1>
        </div>
        <br/>
        <a id="camiseta"></a>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #7CC7FF;">
          <form action="index.php" class="d-flex" method="post">
            <div class="input-group">
                <input class="form-control me-2" type="search" name="buscar" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-warning" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </form>
          <ul class="nav justify-content-center">
            <li>
                @if (isset($_SESSION["usuario"]))
                    Sesión iniciada: {{$_SESSION["first_name"]}}
                @else
                    <a class="nav-link active text-dark" aria-current="page" href="login.php">Iniciar sesión</a>
                @endif
            </li>
            <li>
                @if (isset($_SESSION["usuario"]))
                    <a class="nav-link active text-dark" aria-current="page" href="logout.php">Cerrar sesión</a>
                @endif
            </li>
            <li class="nav-item dropdown">
              @if (isset($_SESSION["usuario"]))
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Menú
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="nav-link text-dark" aria-current="page" href="panel_control.php?id={{$_SESSION["id"]}}">Panel de control</a></li>
                  @if (isset($_SESSION["usuario"]) and $_SESSION["tipo"] == "bibliotecario")
                    <li>
                      <a class="nav-link text-dark" aria-current="page" href="admin/">Administración</a>
                    </li>
                  @endif
                </ul>
              @endif
            </li>
            </li>
          </ul>
        </nav>
    </header>
    <br/>
    <div>
<section id="libros">
    <div class="row">
      @foreach ($libros as $lib)
      <div class="justify-content-start col-md-2">
        <img src="imagenes/{{$lib['foto']}}"><br/>
        <h4 class="text-light">{{$lib["titulo"]}}</h4>
        <p> Disponible: <?= $lib['disponible'] ? 'Si' : 'No'; ?></p>
      </div>
      @endforeach
    </div>
    <br/>
  </section>
  <br/>
</div>
@endsection