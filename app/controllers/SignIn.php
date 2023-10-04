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

                show($_POST);
                unset($_POST['signUp']);
                unset($_POST['re-password']);
                
                // not working properly
                if (!$user-> first($_POST)) {
                    echo "email is already in use";
                    $user->insert($_POST);
                    header("Location: " .ROOT.'/home');
                }
                
            }

            // show($_POST);
        }
        
        $data['errors'] = $user->errors;

        $this->view('signin', $data);
    }
}
