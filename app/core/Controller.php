<?php

class Controller
{

    public function view($name,$data=[])
    {

        if (!empty($data)) {
            extract($data);
            // show($data);
        }

        $filename =  "../app/views/" . $name . ".view.php";
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename =  "../app/views/404.view.php";
            require $filename;
        }
    }
}
