@extends('layouts.plantilla')
@section('contenido')
<div class="container h-100">
	<div class="row h-100 mt-5 justify-content-center align-items-center">
		<div class="col-md-5 mt-5 pt-2 pb-5 align-self-center border bg-dark">
			<h1 class="mx-auto w-25" >Login</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
				}
			?>

			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

				<div class="form-group">
					<label class="text-light" for="email">Email:</label>
					<input type="text" name="email" placeholder="Enter Email" class="form-control">
                </div>

				<div class="form-group">
				<label class="text-light" for="email">Password:</label>
					<input type="password" name="password" placeholder="Enter Password" class="form-control">
				</div>

				<button type="submit" name="submit" class="btn btn-success">Iniciar sesión</button><br/><br/>
				<a href="register.php" class="active-link text-light">¿Aún no te has registrado? Registrate</a><br/><br/>
				<a href="index.php" class="active-link text-light">Volver al Inicio</a>
			
            </form>

		</div>
	</div>
</div>
@endsection