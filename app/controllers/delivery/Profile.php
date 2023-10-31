<?php

class Profile extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        
        // echo "this is a about controller";
        $this->view('delivery/profile');
    }
}
