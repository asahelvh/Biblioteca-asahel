<?php
    
    
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recogemos variables
        $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
        
        // Prepara INSERT
        $miInsert = $miPDO->prepare('INSERT INTO editorial (nombre) VALUES (:nombre)');
        // Ejecuta INSERT con los datos
        $miInsert->execute(
            array(
                'nombre' => $nombre,
            )
        );
        // Redireccionamos a index
        header('Location: index.php');
    }

    echo $blade->run("editorial.nuevo");


?>