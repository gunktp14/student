<?php
    //import file model , controller , config for create object for use
    include_once './src/controller/ps_controller.php';

    //create instance from class
    $ps_controller = new ps_controller();
    $ps_controller->mvcHandler();


?>