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
      $first_name = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
      $stmt = $miPDO->prepare('SELECT * FROM usuarios WHERE first_name LIKE CONCAT("%", :first_name, "%")');
      $stmt->execute(['first_name' => $first_name]);
    } else {
      $stmt = $miPDO->prepare('SELECT * FROM usuarios;');
      $stmt->execute();
    }

    $usuarios = $stmt->fetchAll();
    // Leer entradas.
    


    echo $blade->run("usuarios.index",
        [
          "usuarios" => $usuarios,
        ]);
    
?>  