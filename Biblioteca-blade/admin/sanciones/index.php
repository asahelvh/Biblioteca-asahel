<?php
    if(!$_SESSION['id'] && $_SESSION["tipo"] == "bibliotecario"){

      header('location:../index.php');

    }
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    //BUSCAR:
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $us = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
      $stmt = $miPDO->prepare('SELECT sanciones.*, usuarios.email as us, TIMESTAMPADD(DAY, 5, fecha_creacion) as dias FROM sanciones LEFT JOIN usuarios ON sanciones.usuario_id = usuarios.id WHERE us LIKE CONCAT("%",  :us "%");');
      $stmt->execute(['us' => $us]);
    } else {
      $stmt = $miPDO->prepare('SELECT sanciones.*, usuarios.email as us, TIMESTAMPADD(DAY, 5, fecha_creacion) as dias FROM sanciones LEFT JOIN usuarios ON sanciones.usuario_id = usuarios.id;');
      $stmt->execute();
    }

    $sanciones = $stmt->fetchAll();
    // Leer sanciones.
    
    echo $blade->run("sanciones.index",
        [
          "sanciones" => $sanciones
        ]);
    
?>  