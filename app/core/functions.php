<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function redirect($path){

    header("Location:  ". ROOT ."/"." $path ");
    die;

}