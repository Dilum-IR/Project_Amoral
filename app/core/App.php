<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';

    // split the routing path
    private function splitURL()
    {
        // $URL = $_GET["url"] ?? 'home';
        // $URL = explode("/", $URL);
        // return $URL;
        $URL = $_GET["url"] ?? 'home';
        //$URL = explode("/", $URL);
        return $URL;
    }


    // router path split files name, find the server if not included then, load the 404 file 
    public function loadController()
    {
        $existsRoutes = $GLOBALS['router'];
        $URL = $this->splitURL();
        $routeValue = $URL;
        if(isset($existsRoutes[$routeValue])){
        $routeData = $existsRoutes[$routeValue];
        $filename =  "../app/controllers/" . trim($routeData['class'], '/') . ".php";
        $className = basename($filename, ".php");
        $functionName = trim($routeData['function']);
        if (file_exists($filename)) {
            require $filename;
            $this->method = $functionName;
            $this->controller =  ucfirst($className);
        } 
        
    }else{
        $filename =  "../app/controllers/_404.php";
        require $filename;
        $this->controller =  "_404";
    }


        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], ['a' => "a somthings", 'b' => "b somthing"]);
    }
}
