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
                //show($error);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveP'])) {

                unset($_POST['saveP']);
                $result = $this->changePassword($_POST, $_SESSION['USER']->emp_id, $employee);
                //show($_POST);
            }

            if (!isset($error)) {
                // get the session user data for bind to the profile info

                $employeedata = $this->userInfo($_SESSION['USER']->emp_id, $employee);
            }

            $data['error'] = isset($error) ? $error : "";
            $data['passerror'] = isset($passerror) ? $passerror : "";
            $data['imagerror'] = isset($imagerror) ? $imagerror : "";

            // $data['msg'] = $result;
            // $data['error'] = $employee->errors;


            if (isset($error)) {
                $data['data'] = $_POST;
            } else {
                $data['data'] = $employeedata;
            }

            if (isset($passerror)) {
                $data['pass'] = $_POST;
            }


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

        $empArr['emp_name'] = $row->emp_name;
        $empArr['email'] = $row->email;
        $empArr['DOB'] = $row->DOB;
        $empArr['contact_number'] = $row->contact_number;
        $empArr['emp_image'] = $row->emp_image;
        $empArr['city'] = $row->city;
        $empArr['address'] = $row->address;
        // show($empArr);
        return $empArr;

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

        if ($employee->changeInfoValidate($data)) {

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

            // Update userinfo
            $employee->update($id, $data, 'emp_id');
            $_SESSION['USER']->fullname = $data['fullname'];

            // user email is changed then redirect to the sign in page 
            if ($_SESSION['USER']->email != $data['email']) {

                $data = [];
                $employee->update($id, ['email_verified' => 0], 'emp_id');
                unset($_SESSION["USER"]);
                session_destroy();
                redirect('signin');
            } else {

                redirect('delivery/profile');
            }
            // show($update);
        } else {
            return $employee->errors;
        }
    }




    //  user chanage password
    private function changePassword($data, $id, $employee)
    {

        if ($employee->passwordResetValidate($data)) {

            $arr['emp_id'] = $id;

            $row = $employee->first($arr);

            $checkpassword = password_verify($data['password'], $row->password);
            if ($checkpassword === true) {

                $hash = password_hash($data['confirm_password'], PASSWORD_DEFAULT);
                $update = $employee->update($id, ['password' => $hash], 'emp_id');

                $employee->errors['flag'] = false;
                redirect("delivery/profile");

                return $employee->errors;


            } else {
                $employee->errors['flag'] = true;
                $employee->errors['password'] = "Invalid Current Password";
                return $employee->errors;
            }


        } else {
            return $employee->errors;
        }

    }



    // profile picture uploading
    private function changeImage($data, $id, $user)
    {

        if ($_SESSION['USER']->user_image != "default-img.png") {

            $currentImgPath = ROOT . "/uploads/profile_img/" . explode(' ', $_SESSION['USER']->fullname)[0];

            // Check if the file exists before attempting to delete it
            if (file_exists($currentImgPath)) {

                // Remove the current image
                unlink($currentImgPath);
            }
        }

        $img_name = $_FILES['p_p']['name'];
        $tmp_name = $_FILES['p_p']['tmp_name'];
        $error = $_FILES['p_p']['error'];

        if ($error === 0) {
            // get image extention store it in variable
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

            // convet to image extetion into lowercase and store it in variable
            $img_ex_lc = strtolower($img_ex);

            // allowed image extetions
            $allowed_exs = array("jpg", "jpeg", "png");

            // check the allowed extention is present user upload image
            if (in_array($img_ex_lc, $allowed_exs)) {

                // image name username with image name
                $new_img_name = explode(' ', $_SESSION['USER']->fullname)[0] . "." . $img_ex_lc;

                // bind the change user image for session variable
                $_SESSION['USER']->user_image = $new_img_name;

                // creating upload path on root directory
                $img_upload_path = "../../project_Amoral/public/uploads/profile_img/" . $new_img_name;

                // move upload image for that folder
                move_uploaded_file($tmp_name, $img_upload_path);

                //update the databse image name
                $user->update($id, ['emp_image' => $new_img_name], 'emp_id');
                redirect('delivery/profile');
            } else {
                $fileError['flag'] = true;
                $fileError['error'] = "You can't upload files of '" . $img_ex_lc . " ' type !";
                // header("Location:../../signup.php?error=$em&$data");
                return $fileError;
            }
        }
    }



}
