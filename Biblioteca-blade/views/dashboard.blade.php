@extends('layouts.plantilla')
@section('contenido')
<div class="container">
<h1>Bienvenido {{$_SESSION["usuario"]["first_name"]}}</h1>
</div>
<br><br>
    <h5><a class="text-light" href="index.php">Biblioteca</a></h5>
    <h5><a class="text-light" href="panel_control.php?id={{$_SESSION["id"]}}">Panel de control</a></h5>
    @if (isset($_SESSION["usuario"]) and $_SESSION["tipo"] == "bibliotecario")
        <h5 class="text-light">
            <a class="text-light" href="admin/">Administración</a>
        </h5>
    @endif 
@endsection