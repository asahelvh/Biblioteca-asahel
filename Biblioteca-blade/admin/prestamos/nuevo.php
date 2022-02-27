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

    $stmt = $miPDO->prepare('SELECT COUNT(*) as cuenta, prestamos.usuario_id FROM prestamos GROUP BY prestamos.usuario_id;');
    $stmt->execute();
    $cuenta = $stmt->fetchAll();
    $stmt = $miPDO-> prepare('SELECT * FROM usuarios;');
    $stmt->execute();
    $usuarios = $stmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recogemos variables
        $crear = 0;
        $libro_id = isset($_REQUEST['libro_id']) ? $_REQUEST['libro_id'] : null;
        $usuario_id = isset($_REQUEST['usuario_id']) ? $_REQUEST['usuario_id'] : null;
        $fecha_devolucion = isset($_REQUEST['fecha_devolucion']) ? $_REQUEST['fecha_devolucion'] : null;
        //-------------------------------Verificación-de-usuarios------------------------------
        $stmt = $miPDO->prepare('SELECT COUNT(*) as cuenta, prestamos.usuario_id FROM prestamos GROUP BY prestamos.usuario_id;');
        $stmt->execute();
        $cuenta = $stmt->fetchAll();

        foreach ($cuenta as $key => $value){
            if (isset($value["usuario_id"]) && $value["usuario_id"] == $usuario_id && $value["cuenta"] >= 2) {
                $activo = 1;
                $crear = 1;
                $miUpdate = $miPDO->prepare('UPDATE usuarios SET activo = :activo WHERE id = :usuario_id');
                $miUpdate->execute(
                    [
                        'usuario_id' => $usuario_id,
                        'activo' => $activo
                    ]
                );
            } else {
                $crear = 0;
            }
        }
        //--------------------------------------------------------------------------
        foreach ($usuarios as $key => $value){
            if ($crear != 1 && $usuario_id == $value["id"] && $value["activo"] != 1) {
                $miInsert = $miPDO->prepare('INSERT INTO prestamos (libro_id, usuario_id, fecha_devolucion) VALUES (:libro_id, :usuario_id, :fecha_devolucion);');
                // Ejecuta INSERT con los datos
                $miInsert->execute(
                    array(
                        'libro_id' => $libro_id,
                        'usuario_id' => $usuario_id,
                        'fecha_devolucion' => $fecha_devolucion
                    )
                );
                header('Location: index.php');
            }
        }
        
    }

    $stmt = $miPDO-> prepare('SELECT * FROM libros;');
    $stmt->execute();
    $libros = $stmt->fetchAll();


    

    echo $blade->run("prestamos.nuevo",
        [
            "libros" => $libros,
            "usuarios" => $usuarios,
            "cuenta" => $cuenta
            
        ]);


?>