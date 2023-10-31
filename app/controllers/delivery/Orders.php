<?php

class Orders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        
        // echo "this is a about controller";
        $this->view('garment/orders');
    }

}

