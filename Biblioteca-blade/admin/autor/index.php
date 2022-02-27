<?php
    if(!$_SESSION['id'] && $_SESSION["tipo"] == "bibliotecario"){

      header('location:../index.php');

    }
  require "vendor/autoload.php";
  require "config.php";
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    //BUSCAR:
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $nombre = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
      $stmt = $miPDO->prepare('SELECT * FROM autor WHERE nombre LIKE CONCAT("%", :nombre, "%")');
      $stmt->execute(['nombre' => $nombre]);
    } else {
      $stmt = $miPDO->prepare('SELECT * FROM autor;');
      $stmt->execute();
    }

    $autor = $stmt->fetchAll();
    // Leer entradas.


    echo $blade->run("autor.index",
        [
          "autor" => $autor,
        ]);
    
?>  