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

    public function verifyData()
    {
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            try {

                $user = new User;
                $employee = new Employee;

                $arr['email'] = $_POST['email'];
                $arr['email_verified'] = 0;
                // $arr['email_verified'] = $_POST['email_otp'];

                $user_n  = $_POST['un'];

                $userData = $user->first($arr);
                $empData = $employee->first($arr);

                unset($userData->password);
                unset($userData->phnnum_verified);

                // echo json_encode($userData);
                if ($userData) {
                    // not verified customer email 
                    $user_type = "user";
                    $this->Verify($user, $employee, $_POST, $user_type, $userData);
                } else if (!isset($empData)) {
                    // all data unset method
                    unset($_POST);

                    // verified customer email
                    // redirect to the home page
                    $msg = "Sign In Successfull";
                    $success = 'flag=' . 0 . '&success=' . $msg . '&success_no=' . 2;
                    redirect("customer/overview?$success");
                    exit;
                } else if ($empData) {
                    // not verified employee email 
                    $user_type = "employee";
                    // echo $user_type;
                    $this->Verify($user, $employee, $_POST, $user_type, $empData);
                } else {
                    // all data unset method
                    unset($_POST);

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
                        redirect("merchandiser/overview?$success");
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

    // all data include users data
    private function Verify($user, $employee, $data, $user_type, $allData)
    {

        $arr['email'] = $data['email'];
        // verify that email database include or not
        if (isset($user_type)) {

            // success registration
            $arr['email_otp'] = $data['email_otp'];

            // un data included then it comes from the sign in time
            if (isset($data['un']) && ($data['un'] == 1 || $data['un'] == 2)) {

                if ($user->first($arr)) {

                    // verification code valid, when update the user field
                    $updateData['email_verified'] = 1;
                    $updateData['email_otp'] = 0;
                    $user->update($allData->id, $updateData);

                    // If user email verifed when enabled for users to chat connection table
                    if ($user_type == "user") {

                        $allUsers = new AllUsers();
                        $chat = new Chat();

                        $arr = [];
                        $arr['email'] = $data['email'];
                        $userChatId = $allUsers->first($arr);

                        // chat id find in then chat table
                        $userarr['from_id'] = $userChatId->id;
                        $userarr['to_id'] = $userChatId->id;

                        // session user chat conversation 
                        $chatId = $chat->whereOR($userarr);

                        // when chat id is not included then insert the new user data.
                        if ((empty($chatId))) {

                            $emp = new Employee();

                            // user connect with table include first manager 
                            $arr = [];
                            $arr['emp_status'] = 'manager';

                            $empData = $emp->first_selectedColumn($arr, $emp->chatForCloumn);

                            // find the emp email in all user table
                            $arr = [];
                            $arr['email'] = $empData->email;
                            $empChatId = $allUsers->first($arr);

                            // insert the chat conversation
                            $arr = [];
                            $arr['from_id'] = $empChatId->id;
                            $arr['to_id'] = $userChatId->id;

                            $chat->insert($arr);
                        }
                    }

                    $res['flag'] = 1;
                    $res['title'] = "Valid OTP Code";
                    $res['msg'] = "Verification Successfull 😀🎉";

                    echo json_encode($res);
                    exit;
                } else if ($employee->first($arr)) {

                    // verification code valid, when update the user filed
                    $updateData['email_verified'] = 1;
                    $updateData['email_otp'] = 0;
                    $employee->update($allData->emp_id, $updateData, 'emp_id');

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
            } else {
                // No need to check signup time employees verification.
                // signup verification for popup msgs
                if ($user_type == "user" && $user->first(['email_otp'=>$_POST['email_otp'],'email'=>$_POST['email']])) {

                    // echo json_encode($_POST);
                    // exit;

                    // verification code valid, when update the user filed
                    $updateData['email_verified'] = 1;
                    $updateData['email_otp'] = 0;
                    $user->update($allData->id, $updateData);

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


    public function resendOtp()
    {

        // Resend & update the db otp method
        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {

            // find user in employee and users table
            $user = new User;
            $employee = new Employee;

            $anyId = 0;
            $anyName = "Anonymous ";

            $arr['email'] = $_POST['email'];

            // Generate a random verification code
            $verificationCode = mt_rand(100000, 999999);

            $otpData['email_otp'] = $verificationCode;

            $userData = $user->first($arr);
            $empData = $employee->first($arr);

            //get id for idintify for user & update the that user's verification otp number
            if ($userData) {

                $propertiesToUnset =
                    [
                        'email_otp', 'password', 'phnnum_verified',
                        'user_status', 'token', 'user_image', 'phone', 'email_verified'
                    ];

                foreach ($propertiesToUnset as $property) {
                    if (isset($userData->$property)) {
                        unset($userData->$property);
                    }
                }

                $anyId = $userData->id;
                $anyName = $userData->fullname . " ";
                $response = $user->update($anyId, $otpData);
            } else if ($empData) {

                $anyId = $empData->emp_id;
                $anyName = $empData->emp_name . " ";
                $response = $employee->update($anyId, $otpData, "emp_id");
            } else {
                redirect('home');
            }

            if ($response) {
                $res['flag'] = 1;
                $res['title'] = "Sorry Try Again";
                $res['msg'] = "Can't Sent The OTP Code";

                echo json_encode($res);
            } else {
                $res['flag'] = 0;
                $res['title'] = "Please Try Again";
                $res['msg'] = "OTP Send Successfull 😀🎉";
                echo json_encode($res);
            }

            $otpData['email'] = $_POST['email'];
            $email = $_POST['email'];

            $sendmail = new SendMail;

            $sendmail->sendVerificationEmail($email, $verificationCode, $anyName);
        }
    }
}
