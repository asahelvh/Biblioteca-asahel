<?php
    if(!$_SESSION['id'] && $_SESSION["tipo"] == "bibliotecario"){

        header('location:index.php');

    }
    require "vendor/autoload.php";
    require "config.php";
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
    $apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : null;
    $fecha_nacimiento = isset($_REQUEST['fecha_nacimiento']) ? $_REQUEST['fecha_nacimiento'] : null;
    $fecha_fallecimiento = isset($_REQUEST['fecha_fallecimiento']) ? $_REQUEST['fecha_fallecimiento'] : null;
    $lugar_nacimiento = isset($_REQUEST['lugar_nacimiento']) ? $_REQUEST['lugar_nacimiento'] : null;
    $biografia = isset($_REQUEST['biografia']) ? $_REQUEST['biografia'] : null;
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
        $miUpdate = $miPDO->prepare('UPDATE autor SET nombre = :nombre, apellidos = :apellidos, fecha_nacimiento = :fecha_nacimiento, fecha_fallecimiento = :fecha_fallecimiento, lugar_nacimiento = :lugar_nacimiento, biografia = :biografia, foto = :foto WHERE id = :id');
        // Ejecuta UPDATE con los datos
        $miUpdate->execute(
            [
                'id' => $id,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'fecha_nacimiento' => $fecha_nacimiento,
                'fecha_fallecimiento' => $fecha_fallecimiento,
                'lugar_nacimiento' => $lugar_nacimiento,
                'biografia' => $biografia,
                'foto' => $foto
            ]
        );
        // Redireccionamos a index
        header('Location: index.php');
    } else {
        // Prepara SELECT
        $stmt = $miPDO->prepare('SELECT * FROM autor WHERE id = :id;');
        // Ejecuta consulta
        $stmt->execute(
            [
                'id' => $id
            ]
        );
    }

    // Obtiene un resultado
    $autor = $stmt->fetch();

    echo $blade->run("autor.modificar",
        [
          "autor" => $autor,
          "id" => $id
        ]);

?>