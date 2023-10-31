<?php 

class Profile extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $this->view('customer/profile');
    }
}