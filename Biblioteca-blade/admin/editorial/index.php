<?php
  
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    //BUSCAR:
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $editorial = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
      $stmt = $miPDO->prepare('SELECT * FROM editorial WHERE editorial LIKE CONCAT("%", :editorial, "%")');
      $stmt->execute(['editorial' => $editorial]);
    } else {
      $stmt = $miPDO->prepare('SELECT * FROM editorial;');
      $stmt->execute();
    }

    $editorial = $stmt->fetchAll();
    // Leer entradas.
    


    echo $blade->run("editorial.index",
        [
          "editorial" => $editorial,
        ]);
    
?>  