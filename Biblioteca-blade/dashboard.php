<?php 

    session_start();

    if(!$_SESSION['id']){

        header('location:login.php');

    }
    require "vendor/autoload.php";
    require "config.php";

    use eftec\bladeone\BladeOne;

    $views = __DIR__ . '/views';
    $cache = __DIR__ . '/cache';

    $blade = new BladeOne($views, $cache,BladeOne::MODE_AUTO);
    
    echo $blade->run("dashboard"); 

?>

 

