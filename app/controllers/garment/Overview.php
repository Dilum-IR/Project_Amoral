<?php

class Overview extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {
            
            $this->view('garment/overview');
       
        }else{
            redirect('home');
        }
    }
}
