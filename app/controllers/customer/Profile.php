<?php 

class Profile extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {
            
            $this->view('customer/profile');
       
        }else{
            redirect('home');
        }
    }
}