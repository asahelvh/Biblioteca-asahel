<?php
    session_start();
    require "../vendor/autoload.php";
    require "../config.php";

    use eftec\bladeone\BladeOne;

    $views = '../views';
    $cache = '../cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);

    if(isset($_SESSION["usuario"]) and $_SESSION["tipo"] == "bibliotecario"){
        echo $blade->run("index-admin");
    } else {
        header('Location: ../index.php');
    }

    

?>