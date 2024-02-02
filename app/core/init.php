<?php

spl_autoload_register(function ($classname) {

    require $filename =  "../app/models/" . ucfirst($classname) . ".php";
    

});

spl_autoload_register(function ($classname) {

    // require "../app/helpers/" . ucfirst($classname) . ".php";
    require  "../app/helpers/ajax/" . ucfirst($classname) . ".php";

});


require_once '../app/Providers/Router.php';
require '../app/helpers/sendmail.php'; 
// require '../app/Auth/userValidate.php';
require 'route.php';
require 'App.php';
require '.config.php';
require 'functions.php';
require 'Model.php';
require 'Controller.php';