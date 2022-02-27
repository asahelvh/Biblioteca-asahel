<?php
    if(!$_SESSION['id'] && $_SESSION["tipo"] == "bibliotecario"){

        header('location:login.php');

    }
    require "vendor/autoload.php";
    require "config.php";
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;

    // Comprobamso si recibimos datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepara UPDATE
        $miUpdate = $miPDO->prepare('UPDATE editorial SET nombre = :nombre WHERE id = :id');
        // Ejecuta UPDATE con los datos
        $miUpdate->execute(
            [
                'id' => $id,
                'nombre' => $nombre,
            ]
        );
        // Redireccionamos a index
        header('Location: index.php');
    } else {
        // Prepara SELECT
        $stmt = $miPDO->prepare('SELECT * FROM editorial WHERE id = :id;');
        // Ejecuta consulta
        $stmt->execute(
            [
                'id' => $id
            ]
        );
    }

    // Obtiene un resultado
    $editorial = $stmt->fetch();

    echo $blade->run("editorial.modificar",
        [
          "editorial" => $editorial,
          "id" => $id
        ]);

?>