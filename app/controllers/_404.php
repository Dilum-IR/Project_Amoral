<?php
class _404 extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        
        echo "404 Page Not Found controller";
    }
}



