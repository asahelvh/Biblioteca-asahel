<?php
    session_start();
    require "vendor/autoload.php";
    require "config.php";

    use eftec\bladeone\BladeOne;

    $views = __DIR__ . '/views';
    $cache = __DIR__ . '/cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $stmt = $miPDO->prepare('SELECT prestamos.*, libros.foto as foto, libros.titulo as libro, usuarios.email as us, TIMESTAMPDIFF(DAY, CURRENT_TIMESTAMP, fecha_devolucion ) as dif FROM prestamos LEFT JOIN libros ON prestamos.libro_id = libros.id LEFT JOIN usuarios ON prestamos.usuario_id = usuarios.id WHERE prestamos.usuario_id = :id;');
    $stmt->execute(['id' => $id]);
    $prestamos = $stmt->fetchAll();

    $stmt = $miPDO->prepare('SELECT sanciones.*, usuarios.email as us, TIMESTAMPADD(DAY, 5, fecha_creacion) as dias FROM sanciones LEFT JOIN usuarios ON sanciones.usuario_id = usuarios.id WHERE sanciones.usuario_id = :id;');
    $stmt->execute(['id' => $id]);
    $sanciones = $stmt->fetchAll();

    echo $blade->run("panel_control.index",
        [
            "prestamos" => $prestamos,
            "sanciones" => $sanciones

        ]);

?>