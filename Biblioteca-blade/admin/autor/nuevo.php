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


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recogemos variables
        $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
        $apellidos = isset($_REQUEST['apellidos']) ? $_REQUEST['apellidos'] : null;
        $fecha_nacimiento = isset($_REQUEST['fecha_nacimiento']) ? $_REQUEST['fecha_nacimiento'] : null;
        $fecha_fallecimiento = isset($_REQUEST['fecha_fallecimiento']) ? $_REQUEST['fecha_fallecimiento'] : null;
        $lugar_nacimiento = isset($_REQUEST['lugar_nacimiento']) ? $_REQUEST['lugar_nacimiento'] : null;
        $biografia = isset($_REQUEST['biografia']) ? $_REQUEST['biografia'] : null;
        $foto = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : '';

        if (!empty($_FILES['foto'])) {
            $foto = $_FILES['foto']['name'];
            $formato = $_FILES['foto']['type'];
            $size = $_FILES['foto']['size'];
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
        // Prepara INSERT
        $miInsert = $miPDO->prepare('INSERT INTO autor (nombre, apellidos, fecha_nacimiento, fecha_fallecimiento, lugar_nacimiento, biografia, foto) VALUES (:nombre, :apellidos, :fecha_nacimiento, :fecha_fallecimiento, :lugar_nacimiento, :biografia, :foto)');
        // Ejecuta INSERT con los datos
        $miInsert->execute(
            array(
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'fecha_nacimiento' => $fecha_nacimiento,
                'fecha_fallecimiento' => $fecha_fallecimiento,
                'lugar_nacimiento' => $lugar_nacimiento,
                'biografia' => $biografia,
                'foto' => $foto
            )
        );
        // Redireccionamos a index
        header('Location: index.php');
    }

    echo $blade->run("autor.nuevo");


?>