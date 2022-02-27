@extends('layouts.plantilla')
@section('contenido')
<div class="container h-100">
	<div class="row h-100 mt-5 justify-content-center align-items-center">
		<div class="col-md-5 mt-3 pt-2 pb-5 align-self-center border bg-dark">
			<h1 class="mx-auto w-25" >Register</h1>
			@if(isset($errors) && count($errors) > 0)
					@foreach($errors as $error_msg)
						<div class="alert alert-danger">{{$error_msg}}</div>
					@endforeach
            @endif

            @if(isset($success))      {
                <div class="alert alert-success">{{$success}}</div>
            @endif

			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

                <div class="form-group">
					<label class="text-light" for="email">Nombre:</label>
					<input type="text" name="first_name" placeholder="Enter First Name" class="form-control" value="<?php echo ($valFirstName??'')?>">
				</div>

                <div class="form-group">
					<label class="text-light" for="email">Apellidos:</label>
					<input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" value="<?php echo ($valLastName??'')?>">
				</div>

                <div class="form-group">
					<label class="text-light" for="email">Email:</label>
					<input type="text" name="email" placeholder="Enter Email" class="form-control" value="<?php echo ($valEmail??'')?>">
				</div>

				<div class="form-group">
				<label class="text-light" for="email">Contraseña:</label>
					<input type="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo ($valPassword??'')?>">
				</div>

				<button type="submit" name="submit" class="btn btn-success">Registrarse</button>
				<p class="pt-2"> Volver al <a href="login.php">Login</a></p>

			</form>
		</div>
	</div>
</div>
@endsection