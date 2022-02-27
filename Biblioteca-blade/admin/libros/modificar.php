<?php
    if(!$_SESSION['id'] && $_SESSION["tipo"] == "bibliotecario"){

        header('location:index.php');

    }
    session_start();
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
    $disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;
    $autor_id = isset($_REQUEST['autor_id']) ? $_REQUEST['autor_id'] : null;
    $editorial_id = isset($_REQUEST['editorial_id']) ? $_REQUEST['editorial_id'] : null;
    $categoria_id = isset($_REQUEST['categoria_id']) ? $_REQUEST['categoria_id'] : null;
    $imagen_vieja = isset($_REQUEST['imagen_vieja']) ? $_REQUEST['imagen_vieja'] : '';
    $foto = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : $_REQUEST['imagen_vieja'];

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $formato = $_FILES['foto']['type'];
        $size = $_FILES['foto']['size'];

        if (!empty($foto) && ($size <= 200000000)) {
            if (($formato == "image/gif")
                || ($formato == "image/jpeg") 
                || ($formato == "image/jpg") 
                || ($formato == "image/png")) 
            {
                $directorio ='../../imagenes/';
                move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$foto);
            }else {
                echo "No se puede subir una foto con este formato";
            }
        }else {
            if($foto == !NULL) echo "La foto es demasiado grande";
        }
    }
    // Comprobamso si recibimos datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepara UPDATE
        $miUpdate = $miPDO->prepare('UPDATE libros SET titulo = :titulo, disponible = :disponible, autor_id = :autor_id, editorial_id = :editorial_id, categoria_id = :categoria_id, foto = :foto WHERE id = :id');
        // Ejecuta UPDATE con los datos
        $miUpdate->execute(
            [
                'id' => $id,
                'titulo' => $titulo,
                'disponible' => $disponible,
                'autor_id' => $autor_id,
                'editorial_id' => $editorial_id,
                'categoria_id' => $categoria_id,
                'foto' => $foto
                
            ]
        ); 
        // Redireccionamos a index
        header('Location: index.php');
    } else {
        // Prepara SELECT
        $miConsulta = $miPDO->prepare('SELECT * FROM libros WHERE id = :id;');
        // Ejecuta consulta
        $miConsulta->execute(
            [
                'id' => $id
            ]
        );
    }

    // Obtiene un resultado
    $libros = $miConsulta->fetch();

    $stmt = $miPDO-> prepare('SELECT * FROM autor;');
    $stmt->execute();
    $autor = $stmt->fetchAll();

    $stmt = $miPDO-> prepare('SELECT * FROM categorias;');
    $stmt->execute();
    $categorias = $stmt->fetchAll();

    $stmt = $miPDO-> prepare('SELECT * FROM editorial;');
    $stmt->execute();
    $editorial = $stmt->fetchAll();

    echo $blade->run("libros.modificar",
        [
          "libros" => $libros,
          "autor" => $autor,
          "categorias" => $categorias,
          "editorial" => $editorial,
          "id" => $id
        ]);

?>