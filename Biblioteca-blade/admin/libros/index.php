<?php
    
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    //BUSCAR:
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $titulo = isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : null;
      $stmt = $miPDO->prepare('SELECT libros.*, autor.nombre as au, categorias.nombre as cat, editorial.nombre as ed FROM libros LEFT JOIN autor ON libros.autor_id = autor.id LEFT JOIN editorial ON libros.editorial_id = editorial.id LEFT JOIN categorias ON libros.categoria_id = categorias.id WHERE libros.titulo LIKE CONCAT("%", :titulo, "%")');
      $stmt->execute(['titulo' => $titulo]);
    } else {
      $stmt = $miPDO->prepare('SELECT libros.*, autor.nombre as au, categorias.nombre as cat, editorial.nombre as ed FROM libros LEFT JOIN autor ON libros.autor_id = autor.id LEFT JOIN editorial ON libros.editorial_id = editorial.id LEFT JOIN categorias ON libros.categoria_id = categorias.id;');
      $stmt->execute();
    }

    $libros = $stmt->fetchAll();
    // Leer libros.
    


    echo $blade->run("libros.index",
        [
          "libros" => $libros,
        ]);
    
?>  