<?php
    
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recogemos variables
        $usuario_id = isset($_REQUEST['usuario_id']) ? $_REQUEST['usuario_id'] : null;
        $motivo = isset($_REQUEST['motivo']) ? $_REQUEST['motivo'] : null;
        // Prepara INSERT
        $miInsert = $miPDO->prepare('INSERT INTO sanciones (usuario_id, motivo) VALUES (:usuario_id, :motivo);');
        // Ejecuta INSERT con los datos
        $miInsert->execute(
            array(
                'usuario_id' => $usuario_id,
                'motivo' => $motivo
            )
        );
        // Redireccionamos a Leer
        header('Location: index.php');
    }

    $stmt = $miPDO-> prepare('SELECT * FROM usuarios;');
    $stmt->execute();
    $usuarios = $stmt->fetchAll();

    echo $blade->run("sanciones.nuevo",
        [
            "usuarios" => $usuarios
        ]);


?>