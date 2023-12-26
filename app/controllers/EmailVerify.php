<?php

class EmailVerify extends Controller
{
    public function index()
    {


        if (isset($_SESSION['USER'])) {

            unset($_SESSION['USER']);
        }

        $this->view('utils/emailVerify');
    }

    public function VerifyData()
    {
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            try {

                $user = new User;
                $employee = new Employee;

                $arr['email'] = $_POST['email'];
                $arr['email_otp'] = $_POST['email_otp'];
          
                if ($user->first($arr)) {
                    echo 1;
                } else if ($employee->first($arr)) {
                    echo 1;
                } else {
                    echo 0;
                }
            } catch (\Throwable $th) {
                echo 'data error';
                //throw $th;
            }
        } else {
            redirect('signin');
        }
    }
}
