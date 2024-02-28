<?php

class Profile extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status === 'delivery') {

            $employee = new Employee;

            // information change method
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {

                unset($_POST['save']);
                // show($_POST);
                $error = $this->changeInfo($_POST, $_SESSION['USER']->emp_id, $employee);

            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveP'])) {

                unset($_POST['saveP']);
                $result = $this->changePassword($_POST, $_SESSION['USER']->emp_id, $employee);
                //show($_POST);
            }

            // get the session user data for bind to the profile info
            $data = $this->userInfo($_SESSION['USER']->emp_id, $employee);

            // $data['msg'] = $result;
            // $data['error'] = $employee->errors;

            // show($data);

            $this->view('delivery/profile', $data);

        } else {
            redirect('home');
        }

    }

    //  user still database include data 
    private function userInfo($id, $employee)
    {
        $arr['emp_id'] = $id;

        $row = $employee->first($arr);

        unset($row->password);
        unset($row->emp_id);

        $data['data'] = $row;

        return $data;
        // show($row);

        // $emprow = $employee->first($arr);



    }
    //  user chanage info data
    private function changeInfo($data, $id, $employee)
    {
        // find that user data is not updated. that data is same in the current DB include data
        if ($data['email'] == $_SESSION['USER']->email) {

            $arr['email'] = $data['email'];
            $row = $employee->first($arr);
            //show($row);
            if (
                $data['emp_name'] == $row->emp_name &&
                $data['contact_number'] == $row->contact_number &&
                $data['city'] == $row->city &&
                $data['DOB'] == $row->DOB &&
                $data['address'] == $row->address
            ) {
                $employee->errors['notchange'] = "This Informations are already updated.";
                $employee->errors['flag'] = true;
                return $employee->errors;
            }
        }

        if($employee->changeInfoValidate($data)) {

            $user = new User;

            $arr['email'] = $data['email'];

            $row = $employee->first($arr);
            $userrow = $user->first($arr);

            if ((!empty($row) || !empty($userrow)) && $_SESSION['USER']->email != $data['email']) {
                //show($row);
                $employee->errors['flag'] = true;
                $employee->errors['email'] = "This email is alrady in use.";
                return $employee->errors;
            }

            $employee->update($id, $data, 'id');
            $_SESSION['USER']->fullname = $data['fullname'];

            // user email is changed then redirect to the sign in page 
            if ($_SESSION['USER']->email != $data['email']) {

                $data = [];
                $employee->update($id, ['email_verified' => 0], 'id');
                unset($_SESSION["USER"]);
                session_destroy();
                redirect('signin');
            } else {

                redirect('customer/profile');
            }
            // show($update);
        } else {
            return $employee->errors;
        }
    }





    // if ($employee->changeInfoValidate($data)) {

    //     show($data);
    //     $update = $employee->update($id, $data, 'emp_id');
    //     //echo $update;
    //     if ($update) {

    //         redirect('delivery/profile');

    //     } else {

    //     }

    // }







    //show($data);



    //  user chanage password
    private function changePassword($data, $id, $employee)
    {

        if ($employee->passwordResetValidate($data)) {

            $arr['emp_id'] = $id;

            $row = $employee->first($arr);

            //show($employee->errors);

            $checkpassword = password_verify($data['password'], $row->password);
            if ($checkpassword === true) {

                $hash = password_hash($data['confirm_password'], PASSWORD_DEFAULT);
                $update = $employee->update($id, ['password' => $hash], 'emp_id');
                // echo ("$update");
                // redirect("delivery/profile");

                //show($employee->errors);

                return "success";


            } else {
                return "Invalid";
                //redirect("delivery/profile");
                // echo ("Incorrect password");
            }


        }

    }

}
