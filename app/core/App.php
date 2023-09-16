<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';

    // split the routing path
    private function splitURL()
    {
        $URL = $_GET["url"] ?? 'home';
        $URL = explode("/", $URL);
        return $URL;
    }


    // router path split files name, find the server if not included then, load the 404 file 
    public function loadController()
    {
        $URL = $this->splitURL();
        // show($URL);

        $filename =  "../app/controllers/" . ucfirst($URL[0]) . ".php";
        // echo $URL[0];
        if (file_exists($filename)) {

            require $filename;
            $this->controller =  ucfirst($URL[0]);
        } else {
            //file include in another folder then 
            $filename =  "../app/controllers/" . $URL[0] . "/" . ucfirst($URL[0]) . ".php";
            // echo $filename;
            // echo $URL[0];

            if (file_exists($filename)) {

                require $filename;
                $this->controller =  ucfirst($URL[0]);
            } else {

                $filename =  "../app/controllers/_404.php";
                require $filename;
                $this->controller =  "_404";
            }
        }


        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method], ['a' => "a somthings", 'b' => "b somthing"]);
    }
}
