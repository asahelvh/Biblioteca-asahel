<?php
    session_start();
    require "vendor/autoload.php";
    require "config.php";

    use eftec\bladeone\BladeOne;

    $views = 'views';
    $cache = 'cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
    $options = array("cost" => 4);
    $hpassword = password_hash($password, PASSWORD_BCRYPT, $options);
    // Comprobamso si recibimos datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $miUpdate = $miPDO->prepare('UPDATE usuarios SET password = :password WHERE id = :id');
        
        $miUpdate->execute(
            [
            'id' => $id,
            'password' => $hpassword
            ]
        );
        
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
    $_SESSION["usuario"]["password"] = $hpassword;

    // Obtiene un resultado
    $usuarios = $stmt->fetch();

    echo $blade->run("panel_control.modificarc",
        [
          "usuarios" => $usuarios,
          "id" => $id
        ]);

?>