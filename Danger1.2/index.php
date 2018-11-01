<?php
    session_start();
    require_once './model/ModelUser.php';
    require_once './model/ModelYaddas.php';
   
    require_once './view/ViewLogin.php';
    require_once './view/ViewUser.php';
    require_once './view/ViewEditUser.php';
    require_once './view/ViewYaddas.php';
    require_once './view/ViewProfile.php';
    require_once './controller/Controller.php';

    $controller = new Controller($_GET);
    $controller->doSomething();
?>
