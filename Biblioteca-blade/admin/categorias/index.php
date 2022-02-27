<?php
    
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    //BUSCAR:
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $nombre = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
      $stmt = $miPDO->prepare('SELECT * FROM categorias WHERE nombre LIKE CONCAT("%", :nombre, "%")');
      $stmt->execute(['nombre' => $nombre]);
    } else {
      $stmt = $miPDO->prepare('SELECT * FROM categorias;');
      $stmt->execute();
    }

    $categorias = $stmt->fetchAll();
    // Leer entradas.
    


    echo $blade->run("categorias.index",
        [
          "categorias" => $categorias,
        ]);
    
?>  