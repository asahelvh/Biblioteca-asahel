<?php
    session_start();
    require "vendor/autoload.php";
    require "config.php";

    use eftec\bladeone\BladeOne;

    $views = 'views';
    $cache = 'cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : null;
    $last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : null;
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    // Comprobamso si recibimos datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepara UPDATE
        $miUpdate = $miPDO->prepare('UPDATE usuarios SET first_name = :first_name, last_name = :last_name, email = :email WHERE id = :id');
        // Ejecuta UPDATE con los datos
        $miUpdate->execute(
            [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
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
    $_SESSION["first_name"] = $first_name;
    $_SESSION["last_name"] = $last_name;
    $_SESSION["email"] = $email;

    // Obtiene un resultado
    $usuarios = $stmt->fetch();

    echo $blade->run("panel_control.modificaru",
        [
          "usuarios" => $usuarios,
          "id" => $id
        ]);

?>