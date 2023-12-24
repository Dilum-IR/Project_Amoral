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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn'])) {

            // show($_POST);
            if ($user->signInData($_POST)) {

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
                        $username  = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
                        // echo $username;

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
                        } else  if ($emprow->emp_status == 'merchandiser') {
                            redirect('garment/overview');
                        }
                    }

                    // echo "Valid password";

                }
                //  else {
                //     $data['errors'] = "";
                //     $user->errors = "Worng Email or Password";
                //     $data['errors'] = $user->errors;

                //     // echo "Invalid Sign-In";
                // }

            }
        }

        // ---------------------------- --------------------------------
        // All customers are Sign Up to the System 
        // ---------------------------- --------------------------------

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signUp'])) {

            if ($user->validate($_POST)) {

                unset($_POST['signUp']);
                unset($_POST['re-password']);

                //check the email used or not
                if (!$user->findUser($_POST)) {
                    $_POST['user_status'] = "customer";
                    // show($_POST);

                    // echo "email is already in use";
                    $user->insert($_POST);
                    header("Location: " . ROOT . '/home');
                }
            }
        }


        $data['errors'] = $user->errors;


        // ---------------------------- --------------------------------
        // If found the errors at data validation time then , Sign Up & Sign In redirect pages 
        // ---------------------------- --------------------------------

        if (!empty($data['errors']) && isset($_POST['signUp'])) {

            $passData = 'name=' . $_POST['fullname'] . '&email=' . $_POST['email'] . '&pass=' . $_POST['password'] . '&repass=' . $_POST['re-password'];
            $error = 'flag=' . $data['errors']['flag'] . '&error=' . $data['errors']['error'] . '&error_no=' . $data['errors']['error_no'];

            unset($_POST['signUp']);

            // redirect("signup?$error&$passData");
            // exit;
        } else if (!empty($data['errors']) && isset($_POST['signIn'])) {
            $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
            // $error = 'flag=' . $data['errors']['flag'] . '&error=' . $data['errors']['error'] . '&error_no=' . $data['errors']['error_no'];

            unset($_POST['signIn']);

            // redirect("signin?$error&$passData");
            // exit;
        }

        show($data);

        $this->view('signin', $data);
    }

}

// all data unset method
// foreach ($_POST as $key => $value) {
//     unset($_POST[$key]);
// }
