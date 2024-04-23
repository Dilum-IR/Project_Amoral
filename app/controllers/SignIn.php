<?php

class SignIn extends Controller
{
    // use Auth;

    public function index()
    {

        $user = new User;
        $employee = new Employee;

        if (isset($_SESSION['USER'])) {

            $curr_row = $_SESSION['USER'];
            try {
                if ($curr_row->user_status == 'customer') {
                    redirect('customer/overview');
                } else if ($curr_row->emp_status == 'manager') {

                    redirect('manager/overview');
                } else if ($curr_row->emp_status == 'delivery') {
                    redirect('delivery/overview');
                } else  if ($curr_row->emp_status == 'garment') {
                    redirect('merchandiser/overview');
                } else  if ($curr_row->emp_status == 'merchandiser') {
                     redirect('garment/overview');
                }
            } catch (Throwable $th) {
                throw $th;
            }
        }

        // ---------------------------- --------------------------------
        // All users Sign In to the their overviews 
        // ---------------------------- --------------------------------
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn'])) {

            $this->userLogin($user, $employee);
        }

        // ---------------------------- --------------------------------
        // All customers are Sign Up to the System 
        // ---------------------------- --------------------------------

        else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signUp'])) {

            $this->userRegister($user, $employee, $_POST);
        }

        $data['errors'] = $user->errors;

        // ---------------------------- --------------------------------
        // If found the errors at data validation time then , Sign Up & Sign In redirect pages 
        // ---------------------------- --------------------------------
        $this->errorHandler($data);


        $this->view('signin', $data);
    }

    private function userLogin($user, $employee)
    {
        try {
            if ($user->signInData($_POST)) {

                $arr['email'] = $_POST['email'];

                $row = $user->first($arr);

                $emprow = $employee->first($arr);


                if ($row) {

                    $checkpassword = password_verify($_POST['password'], $row->password);

                    if ($checkpassword == true) {

                        unset($row->password);

                        if ($row->email_verified === 0) {
                            // not verified redirect to the verify page
                            $hashMail = password_hash($row->email, PASSWORD_DEFAULT);

                            $msg = 'error_no=' . 9 . '&flag=' . 1 . '&hash=' . $hashMail . '&code=' . 19258387 . '&email=' . urlencode($row->email) . '&u=' . 1;
                            redirect("verify?$msg");
                            exit;
                        } else {
                            // popup seccess msg


                            // genarate token
                            // $token = $this->generateToken();

                            // $data['token'] = $token;
                            // $this->updateUserToken($row->id, $data, 'id', $user);

                            // create session variable
                            session_start();
                            $_SESSION['USER'] = $row;
                            // $_SESSION['user_token'] = $token;
                            $_SESSION['token_expiry'] = time() + (60 * 30);
                            
                            // check session user
                            $username  = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;


                            $msg = "Sign In Successfull";
                            $success = 'flag=' . 0 . '&success=' . $msg . '&success_no=' . 2;

                            if ($row->user_status == 'customer') {
                                redirect("customer/overview?$success");
                                exit;
                            }
                        }
                    } else {
                        $error = "Invalid Email or Password";

                        $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                        $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7;

                        unset($_POST['signIn']);

                        redirect("signin?$errors&$passData");
                        exit;
                    }
                } elseif ($emprow) {

                    $checkpassword = password_verify($_POST['password'], $emprow->password);

                    if ($checkpassword) {

                        unset($emprow->password);

                        if ($emprow->email_verified === 0) {
                            // not verified redirect to the verify page
                            $hashMail = password_hash($emprow->email, PASSWORD_DEFAULT);

                            $msg = 'error_no=' . 9 . '&flag=' . 1 . '&hash=' . $hashMail . '&code=' . 19258387 . '&email=' . urlencode($emprow->email) . '&u=' . 2;
                            redirect("verify?$msg");
                            exit;
                        } else {

                            // create session variable
                            session_start();
                            $_SESSION['USER'] = $emprow;

                            // check session user
                            $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

                            // all data unset method
                            foreach ($_POST as $key => $value) {
                                unset($_POST[$key]);
                            }

                            $msg = "Sign In Successfull";
                            $success = 'flag=' . 0 . '&success=' . $msg . '&success_no=' . 2;

                            if ($emprow->emp_status == 'delivery') {
                                redirect("delivery/overview?$success");
                                exit;
                            } else  if ($emprow->emp_status == 'garment') {
                                redirect("garment/overview?$success");
                                exit;
                            } else  if ($emprow->emp_status == 'merchandiser') {
                                 redirect("merchandiser/overview?$success");
                                exit;
                            } else if ($emprow->emp_status == 'manager') {
                                redirect("manager/overview?$success");
                                exit;
                            } else {
                                redirect("home");
                                exit;
                            }
                        }
                    } else {

                        $error = "Invalid Email or Password";

                        $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                        $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7;

                        unset($_POST['signIn']);

                        redirect("signin?$errors&$passData");
                        exit;
                    }
                } else {

                    $error = "Invalid Email or Password";

                    $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                    $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 7;

                    unset($_POST['signIn']);

                    redirect("signin?$errors&$passData");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // ---------------------------- --------------------------------
    // All customers are Sign Up to the System 
    // ---------------------------- --------------------------------
    private function userRegister($user, $employee, $POST)
    {
        try {
            $email = $POST['email'];
            $password = $POST['password'];
            $re_password = $POST['re-password'];

            if ($user->validate($_POST)) {

                unset($POST['signUp']);
                unset($POST['re-password']);

                //check the email used or not
                if (!$user->findUser($POST) && !$employee->findUser($POST)) {

                    // Generate a random verification code
                    $verificationCode = mt_rand(100000, 999999);

                    $POST['email_otp'] = $verificationCode;
                    $POST['password'] = $_POST['password'];

                    $sendmail = new SendMail;

                    $res = $sendmail->sendVerificationEmail($email, $verificationCode, $POST['fullname']);

                    $user->insert($POST);

                    // save user email in another table for chat with users
                    $all_users = new AllUsers();
                    $arr['email'] = $_POST['email'];
                    $all_users->insert($arr);


                    // email hashing & redirect to the OTP verify page
                    if ($res) {

                        $hashMail = password_hash($POST['email'], PASSWORD_DEFAULT);

                        $msg = 'success_no=' . 3 . '&flag=' . 0 . '&hash=' . $hashMail . '&code=' . 19258387 . '&email=' . urlencode($POST['email']);

                        // all data unset method
                        foreach ($_POST as $key => $value) {
                            unset($_POST[$key]);
                        }

                        redirect("verify?$msg");
                        exit;
                    } else if (!$res) {
                        $hashMail = password_hash($POST['email'], PASSWORD_DEFAULT);

                        $msg = 'error_no=' . 8 . '&flag=' . 1 . '&hash=' . $hashMail . '&code=' . 19258387 . '&email=' . urlencode($POST['email']);

                        redirect("verify?$msg");
                        exit;
                    } else {
                    }
                } else {
                    $error = "Email is Already in use";
                    $errors = 'flag=' . 1 . '&error=' . $error . '&error_no=' . 3;

                    $passData = 'name=' . $POST['fullname'] . '&email=' . $email . '&pass=' . $password . '&repass=' . $re_password;

                    redirect("signup?$errors&$passData");
                    exit;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // ---------------------------- --------------------------------
    // If found the errors at data validation time then , Sign Up & Sign In redirect pages 
    // ---------------------------- --------------------------------
    private function errorHandler($data)
    {
        try {
            if (!empty($data['errors']) && isset($_POST['signUp'])) {

                $passData = 'name=' . $_POST['fullname'] . '&email=' . $_POST['email'] . '&pass=' . $_POST['password'] . '&repass=' . $_POST['re-password'];
                $error = 'flag=' . $data['errors']['flag'] . '&error=' . $data['errors']['error'] . '&error_no=' . $data['errors']['error_no'];

                unset($_POST['signUp']);

                redirect("signup?$error&$passData");
                exit;
            } else if (!empty($data['errors']) && isset($_POST['signIn'])) {
                $passData = 'email=' . $_POST['email'] . '&pass=' . $_POST['password'];
                $error = 'flag=' . $data['errors']['flag'] . '&error=' . $data['errors']['error'] . '&error_no=' . $data['errors']['error_no'];

                unset($_POST['signIn']);

                redirect("signin?$error&$passData");
                exit;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}