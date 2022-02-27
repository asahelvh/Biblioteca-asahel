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
    $usuario_id = isset($_REQUEST['usuario_id']) ? $_REQUEST['usuario_id'] : null;
    $motivo = isset($_REQUEST['motivo']) ? $_REQUEST['motivo'] : null;
    

    // Comprobamso si recibimos datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepara UPDATE
        $miUpdate = $miPDO->prepare('UPDATE sanciones SET usuario_id = :usuario_id, motivo = :motivo WHERE id = :id');
        // Ejecuta UPDATE con los datos
        $miUpdate->execute(
            [
                'id' => $id,
                'usuario_id' => $usuario_id,
                'motivo' => $motivo
                
            ]
        );
        // Redireccionamos a index
        header('Location: index.php');
    } else {
        // Prepara SELECT
        $miConsulta = $miPDO->prepare('SELECT * FROM sanciones WHERE id = :id;');
        // Ejecuta consulta
        $miConsulta->execute(
            [
                'id' => $id
            ]
        );
    }
    // Obtiene un resultado
    $sanciones = $miConsulta->fetch();

    $stmt = $miPDO-> prepare('SELECT * FROM usuarios;');
    $stmt->execute();
    $usuarios = $stmt->fetchAll();


    echo $blade->run("sanciones.modificar",
        [
          "sanciones" => $sanciones,
          "usuarios" => $usuarios,
          "id" => $id
        ]);

?>