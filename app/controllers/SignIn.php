<?php

class SignIn extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        // echo "this is a about controller";
        if(isset($_POST['signIn'])){
            show($_POST);

        }
        

        $user = new User;
        if ($user->validate($_POST)) {
            
            $user->insert($_POST);
            redirect('home');
        }

        if(isset($_POST['signUp'])){
            show($_POST);

        }
        $this->view('signin');
    }
}
