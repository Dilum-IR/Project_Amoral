<?php

spl_autoload_register(function ($classname) {

    require $filename =  "../app/models/" . ucfirst($classname) . ".php";
});
require_once '../app/Providers/Router.php';
require 'route.php';
require 'App.php';
require '.config';
require 'functions.php';
require 'Model.php';
require 'Controller.php';

