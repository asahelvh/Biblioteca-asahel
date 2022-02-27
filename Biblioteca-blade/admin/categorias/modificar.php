<?php
    if(!$_SESSION['id'] && $_SESSION["tipo"] == "bibliotecario"){

        header('location:index.php');

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
        $miUpdate = $miPDO->prepare('UPDATE categorias SET nombre = :nombre WHERE id = :id');
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
        $stmt = $miPDO->prepare('SELECT * FROM categorias WHERE id = :id;');
        // Ejecuta consulta
        $stmt->execute(
            [
                'id' => $id
            ]
        );
    }

    // Obtiene un resultado
    $categorias = $stmt->fetch();

    echo $blade->run("categorias.modificar",
        [
          "categorias" => $categorias,
          "id" => $id
        ]);

?>