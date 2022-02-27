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
    
    $stmt = $miPDO-> prepare('DELETE FROM sanciones WHERE id = :id');
    
    $stmt->execute([
        "id" => $id
    ]);
    
    header('Location: index.php');

?>