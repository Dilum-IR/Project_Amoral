<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
    die();
}

function redirect($path){

    header("Location:  ". ROOT ."/"."$path");
    die;

}