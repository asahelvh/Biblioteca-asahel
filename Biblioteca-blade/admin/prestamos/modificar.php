<?php
    if(!$_SESSION['id'] && $_SESSION["tipo"] == "bibliotecario"){

        header('location:index.php');

    }
    require "../../vendor/autoload.php";
    require "../../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../../views';
    $cache = '../../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $libro_id = isset($_REQUEST['libro_id']) ? $_REQUEST['libro_id'] : null;
    $usuario_id = isset($_REQUEST['usuario_id']) ? $_REQUEST['usuario_id'] : null;
    $fecha_prestamo = isset($_REQUEST['fecha_prestamo']) ? $_REQUEST['fecha_prestamo'] : null;
    $fecha_devolucion = isset($_REQUEST['fecha_devolucion']) ? $_REQUEST['fecha_devolucion'] : null;
    

    // Comprobamso si recibimos datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepara UPDATE
        $miUpdate = $miPDO->prepare('UPDATE prestamos SET libro_id = :libro_id, usuario_id = :usuario_id, fecha_prestamo = :fecha_prestamo, fecha_devolucion = :fecha_devolucion WHERE id = :id');
        // Ejecuta UPDATE con los datos
        $miUpdate->execute(
            [
                'id' => $id,
                'libro_id' => $libro_id,
                'usuario_id' => $usuario_id,
                'fecha_prestamo' => $fecha_prestamo,
                'fecha_devolucion' => $fecha_devolucion
                
            ]
        );
        // Redireccionamos a index
        header('Location: index.php');
    } else {
        // Prepara SELECT
        $miConsulta = $miPDO->prepare('SELECT * FROM prestamos WHERE id = :id;');
        // Ejecuta consulta
        $miConsulta->execute(
            [
                'id' => $id
            ]
        );
    }

    // Obtiene un resultado
    $prestamos = $miConsulta->fetch();

    $stmt = $miPDO-> prepare('SELECT * FROM libros;');
    $stmt->execute();
    $libros = $stmt->fetchAll();

    $stmt = $miPDO-> prepare('SELECT * FROM usuarios;');
    $stmt->execute();
    $usuarios = $stmt->fetchAll();


    echo $blade->run("prestamos.modificar",
        [
          "prestamos" => $prestamos,
          "libros" => $libros,
          "usuarios" => $usuarios,
          "id" => $id
        ]);

?>