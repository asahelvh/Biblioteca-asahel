@extends('layouts.plantilla-a')
@section('contenido')
<body>
    <h1>Menú de Administración</h1>
    <br>

    <ul>
        <li><a href="libros/">Libros</a></li>
        <li><a href="categorias/">Categorías</a></li>
        <li><a href="editorial/">Editorial</a></li>
        <li><a href="autor/">Autor</a></li>
        <li><a href="prestamos/">Prestamos</a></li>
        <li><a href="usuarios/">Usuarios</a></li>
        <li><a href="sanciones/">Sanciones</a></li>
    </ul> 

    <h4><a href="../index.php"> Volver al inicio </a></h4>
@endsection