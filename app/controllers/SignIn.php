<?php

class SignIn extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $user = new User;

        // echo "this is a about controller";
        
        if (isset($_POST['signIn'])) {
            show($_POST);
        }


        if (isset($_POST['signUp'])) {

            if ($user->validate($_POST)) {

                $user->insert($_POST);
                redirect('home');
            }
            show($_POST);
        }
        
        $data['errors'] = $user->errors;

        $this->view('signin', $data);
    }
}
