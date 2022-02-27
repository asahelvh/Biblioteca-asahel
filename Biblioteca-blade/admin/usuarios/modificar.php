<?php
    
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
    $last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
    $tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : null;
    $activo = isset($_REQUEST['activo']) ? $_REQUEST['activo'] : null;
    $options = array("cost" => 4);
    $hpassword = password_hash($password, PASSWORD_BCRYPT, $options);
    // Comprobamso si recibimos datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepara UPDATE
        $miUpdate = $miPDO->prepare('UPDATE usuarios SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, tipo = :tipo, activo = :activo WHERE id = :id');
        // Ejecuta UPDATE con los datos
        $miUpdate->execute(
            [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $hpassword,
                'tipo' => $tipo,
                'activo'=> $activo
            ]
        );
        // Redireccionamos a index
        header('Location: index.php');
    } else {
        // Prepara SELECT
        $stmt = $miPDO->prepare('SELECT * FROM usuarios WHERE id = :id;');
        // Ejecuta consulta
        $stmt->execute(
            [
                'id' => $id
            ]
        );
    }

    // Obtiene un resultado
    $usuarios = $stmt->fetch();

    echo $blade->run("usuarios.modificar",
        [
          "usuarios" => $usuarios,
          "id" => $id
        ]);

?>