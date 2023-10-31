<?php

class SignIn extends Controller
{

    public function index()
    {
        $user = new User;
        // show($_POST);

        if (isset($_POST['signIn'])) {

            if ($this->formData($_POST)) {

                $arr['email'] = $_POST['email'];
                $row = $user->first($arr);

                // show($row);
                
                if ($row) {

                    $checkpassword = password_verify($_POST['password'], $row->password);

                    if ($checkpassword == true) {

                        unset($row->password);
                        $_SESSION['USER'] = $row;


                        // check session user
                        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
                        show($username);

                        
                        redirect('customer/overview');
                        echo "Valid password";
                    } else {
                        $data['errors'] = "";
                        $user->errors = "Worng Email or Password";
                        $data['errors'] = $user->errors;

                        echo "Invalid Sign-In";
                    }
                } else {
                    $data['errors'] = "";
                    $user->errors = "Worng Email or Password";
                    $data['errors'] = $user->errors;
                    echo "Invalid Sign-In";
                }
            }
        }

        if (isset($_POST['signUp'])) {
            
            if ($user->validate($_POST)) {
                
                unset($_POST['signUp']);
                unset($_POST['re-password']);
                show($_POST);

                //check the email used or not
                if (!$user->findUser($_POST)) {
                    // echo "email is already in use";
                    $user->insert($_POST);
                    header("Location: " . ROOT . '/home');
                }
            }

            // show($_POST);
        }

        $data['errors'] = $user->errors;

        $this->view('signin', $data);
    }

    private function formData($data)
    {
        $errors = [];

        // is empty email 
        if (empty($data['email'])) {

            $errors['flag'] = true;
            $errors['email'] = "Email is Required";
        }

        // email validation
        // if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        //     $errors['flag'] = true;
        //     $errors['email'] = "Email is not Valid";
        // }

        // is empty password 
        if (empty($data['password'])) {
            $errors['flag'] = true;
            $errors['password'] = "password is Required";
        }

        if (empty($errors)) {

            return true;
        } else {
            return false;
        }

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //     $email = $_POST['email'];
        //     $password = $_POST['password'];
        // }





    }
}
