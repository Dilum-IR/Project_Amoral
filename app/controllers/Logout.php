<?php

class Logout extends Controller
{
    public function index()
    {
        if (!empty($_SESSION["USER"])) {
            unset($_SESSION["USER"]);
        }
        session_destroy(); 
        redirect('home');
    }
}