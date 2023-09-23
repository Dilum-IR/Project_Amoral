<?php

spl_autoload_register(function ($classname) {

    require $filename =  "../app/models/" . ucfirst($classname) . ".php";
});


require 'App.php';
require '.config.php';
require 'functions.php';
require 'Model.php';
require 'Controller.php';
