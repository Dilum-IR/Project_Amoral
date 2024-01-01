<?php

class EmailVerify extends Controller
{
    public function index()
    {


        if (isset($_SESSION['USER'])) {

            unset($_SESSION['USER']);
        }

        // Resend method
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            // show($_POST);
            echo "resend";
            $user = new User;
            $employee = new Employee;

            $arr['email'] = $_POST['email'];

            $userData = $user->first($arr);
            $empData = $user->first($arr);


            if ($userData) {
            } else if ($empData) {
            }
        }

        $this->view('utils/emailVerify');
    }

    public function verifyData()
    {
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            try {

                $user = new User;
                $employee = new Employee;

                $arr['email'] = $_POST['email'];
                $arr['email_verified'] = 0;

                $user_n  = $_POST['un'];

                $userData = $user->first($arr);

                unset($userData->password);
                unset($userData->phnnum_verified);

                // echo json_encode($userData);
                if ($userData) {
                    // not verified customer email 
                    $this->Verify($user, $employee, $_POST);
                } else {
                    // all data unset method
                    foreach ($_POST as $key => $value) {
                        unset($_POST[$key]);
                    }
                    // verified customer email
                    // redirect to the home page
                    $msg = "Sign In Successfull";
                    $success = 'flag=' . 0 . '&success=' . $msg . '&success_no=' . 2;
                    redirect("customer/overview?$success");
                    exit;
                }

                $empData = $employee->first($arr);

                if ($empData && $user_n === 2) {
                    // not verified employee email 
                    $this->Verify($user, $employee, $_POST);
                } else {
                    // all data unset method
                    foreach ($_POST as $key => $value) {
                        unset($_POST[$key]);
                    }
                    // verified employee email 
                    // redirect to the own page
                    $msg = "Sign In Successfull";
                    $success = 'flag=' . 0 . '&success=' . $msg . '&success_no=' . 2;

                    if ($empData->emp_status == 'delivery') {
                        redirect("delivery/overview?$success");
                        exit;
                    } else  if ($empData->emp_status == 'garment') {
                        redirect("garment/overview?$success");
                        exit;
                    } else  if ($empData->emp_status == 'merchandiser') {
                        redirect("garment/overview?$success");
                        exit;
                    } else if ($empData->emp_status == 'manager') {
                        redirect("manager/overview?$success");
                        exit;
                    } else {
                        redirect("home");
                        exit;
                    }
                }
            } catch (\Throwable $th) {
                echo 'data error';
                //throw $th;
            }
        } else {
            redirect('home');
        }
    }

    public function resendOtp()
    {
    }

    private function Verify($user, $employee, $data)
    {

        $arr['email'] = $data['email'];
        // verify that email database include or not
        if ($user->first($arr)) {

            // success registration
            $arr['email_otp'] = $data['email_otp'];

            // un data included then it comes from the sign in time
            if (isset($data['un']) && ($data['un'] == 1 || $data['un'] == 2)) {
                if ($user->first($arr)) {

                    $res['flag'] = 1;
                    $res['title'] = "Valid OTP Code";
                    $res['msg'] = "Verification Successfull 😀🎉";

                    // echo json_encode($res);
                    // want to add redirect part for login users
                    redirect("home");

                    // echo '<script>';
                    // echo 'setTimeout(function() {';
                    // echo '  window.location.href = "http://localhost/project_Amoral/public/signin";'; // Replace with your desired URL
                    // echo '}, 5000);'; 
                    // echo '</script>';
                    
                    exit;
                } else {

                    $res['flag'] = 0;
                    $res['title'] = "Invalid OTP Code ";
                    $res['msg'] = "Verification Invalid. Try Again";
                    echo json_encode($res);
                    exit;
                }
            } else {
                // signup verification for popup msgs
                if ($employee->first($arr)) {
                    $res['flag'] = 1;
                    $res['title'] = "Valid OTP Code ";
                    $res['msg'] = "Verification Successfull 😀🎉";
                    echo json_encode($res);
                    exit;
                } else {
                    $res['flag'] = 0;
                    $res['title'] = "Invalid OTP Code ";
                    $res['msg'] = "Verification Invalid. Try Again";

                    echo json_encode($res);
                    exit;
                }
            }
        } else {
            // registration process faild
            echo 0;
        }
    }
}
