<?php
    
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recogemos variables
        $first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
        $last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
        $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
        $tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : null;
        $activo = isset($_REQUEST['activo']) ? $_REQUEST['activo'] : null;
        $options = array("cost" => 4);
        $hpassword = password_hash($password, PASSWORD_BCRYPT, $options);
        
        // Prepara INSERT
        $miInsert = $miPDO->prepare('INSERT INTO usuarios (first_name, last_name, email, password, tipo, activo) VALUES (:first_name, :last_name, :email, :password, :tipo, :activo);');
        // Ejecuta INSERT con los datos
        $miInsert->execute(
            array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $hpassword,
                'tipo' => $tipo,
                'activo'=> $activo
            )
        );
        // Redireccionamos a index
        header('Location: index.php');
    }

    echo $blade->run("usuarios.nuevo");


?>