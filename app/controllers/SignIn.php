<?php

class SignIn extends Controller
{

    public function index()
    {

        $user = new User;
        $employee = new Employee;

        // show($_SESSION['USER']);
        if (isset($_SESSION['USER'])) {

            unset($_SESSION['USER']);
        } else {
            isset($_SESSION['USER']);
        }


        // ---------------------------- --------------------------------
        // All users Sign In to the their overviews 
        // ---------------------------- --------------------------------
        if (isset($_POST['signIn'])) {

            // show($_POST);
            if ($this->formData($_POST)) {

                $arr['email'] = $_POST['email'];
                $row = $user->first($arr);

                $emprow = $employee->first($arr);
                // show($emprow);

                if ($row) {

                    $checkpassword = password_verify($_POST['password'], $row->password);

                    if ($checkpassword == true) {

                        unset($row->password);
                        $_SESSION['USER'] = $row;

                        // show($row);

                        // check session user
                        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
                        echo $username;

                        if ($row->user_status == 'customer') {
                            redirect('customer/overview');
                        }

                        // echo "Valid password";
                    } else {
                        $data['errors'] = "";
                        $user->errors = "Worng Email or Password";
                        $data['errors'] = $user->errors;

                        // echo "Invalid Sign-In";
                    }
                } elseif ($emprow) {

                    $checkpassword = password_verify($_POST['password'], $emprow->password);

                    if ($checkpassword) {

                    unset($emprow->password);
                    $_SESSION['USER'] = $emprow;

                    // check session user
                    $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
                    // show($username);

                    if ($emprow->emp_status == 'manager') {
                        // show($emprow);
                        redirect('manager/overview');
                    } else if ($emprow->emp_status == 'delivery') {
                        redirect('delivery/overview');
                    } else  if ($emprow->emp_status == 'garment') {
                        redirect('garment/overview');
                    }
                    } else  if ($emprow->emp_status == 'merchandiser') {
                        redirect('garment/overview');
                    }
                    // echo "Valid password";

                    }
                    //  else {
                    //     $data['errors'] = "";
                    //     $user->errors = "Worng Email or Password";
                    //     $data['errors'] = $user->errors;

                    //     // echo "Invalid Sign-In";
                    // }

                } else {
                    $data['errors'] = "";
                    $user->errors = "Worng Email or Password";
                    $data['errors'] = $user->errors;
                    // echo "Invalid Sign-In";
                }
            }
    
        // ---------------------------- --------------------------------
        // All customers are Sign Up to the System 
        // ---------------------------- --------------------------------

        if (isset($_POST['signUp'])) {

            if ($user->validate($_POST)) {

                unset($_POST['signUp']);
                unset($_POST['re-password']);

                //check the email used or not
                if (!$user->findUser($_POST)) {
                    $_POST['user_status'] = "customer";
                    show($_POST);

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
