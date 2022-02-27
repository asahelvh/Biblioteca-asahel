<?php
    
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);
    $mensaje = "";
    //BUSCAR:

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $libro = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
      $stmt = $miPDO->prepare('SELECT prestamos.*, libros.titulo as libro, usuarios.email as us, TIMESTAMPDIFF(DAY, CURRENT_TIMESTAMP, fecha_devolucion ) as dif FROM prestamos LEFT JOIN libros ON prestamos.libro_id = libros.id LEFT JOIN usuarios ON prestamos.usuario_id = usuarios.id WHERE libros.titulo LIKE CONCAT("%",  :libro "%");');
      $stmt->execute(['libro' => $libro]);
    } else {
      $stmt = $miPDO->prepare('SELECT prestamos.*, libros.titulo as libro, usuarios.email as us, TIMESTAMPDIFF(DAY, CURRENT_TIMESTAMP, fecha_devolucion ) as dif FROM prestamos LEFT JOIN libros ON prestamos.libro_id = libros.id LEFT JOIN usuarios ON prestamos.usuario_id = usuarios.id;');
      $stmt->execute();
    }

    $prestamos = $stmt->fetchAll();

    echo $blade->run("prestamos.index",
        [
          "prestamos" => $prestamos
        ]);
    
?>  