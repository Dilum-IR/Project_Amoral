<?php

class Profile extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->user_status === 'customer') {

            $user = new User;

            // information change method
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
                unset($_POST['save']);
                // show($_POST);
                $error = $this->changeInfo($_POST, $_SESSION['USER']->id, $user);
            }

            // password change method
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveP'])) {

                unset($_POST['saveP']);
                $passerror = $this->changePassword($_POST, $_SESSION['USER']->id, $user);
                // show($error);
            }
            // image changed method
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_Image']) && isset($_FILES['p_p'])) {

                unset($_POST['change_Image']);
                $imagerror = $this->changeImage($_POST, $_SESSION['USER']->id, $user);
                // show($_POST);
            }

            if (!isset($error)) {
                // get the session user data for bind to the profile info
                $userData  = $this->userInfo($_SESSION['USER']->id, $user);
            }

            $data['error'] = isset($error) ? $error : "";
            $data['passerror'] = isset($passerror) ? $passerror : "";
            $data['imagerror'] = isset($imagerror) ? $imagerror : "";

            // echo "<pre>";
            // show($data);
            // echo "</pre>";

            if (isset($error)) {
                $data['data'] = $_POST;
            } else {
                $data['data'] = $userData;
            }

            if (isset($passerror)) {
                $data['pass'] = $_POST;
            }


            // show($data);

            $this->view('customer/profile', $data);
        } else {
            redirect('home');
        }
    }

    private function userInfo($id, $user)
    {

        $arr['id'] = $id;

        $row = $user->first($arr);

        unset($row->password);
        unset($row->id);
        // print_r($row);

        $userArr['fullname'] = $row->fullname;
        $userArr['email'] = $row->email;
        $userArr['phone'] = $row->phone;
        $userArr['user_image'] = $row->user_image;
        $userArr['city'] = $row->city;
        $userArr['address'] = $row->address;
        // show($userArr);

        return $userArr;
    }

    //  user chanage info data
    private function changeInfo($data, $id, $user)
    {
        // find that user data is not updated. that data is same in the current DB include data
        if ($data['email'] == $_SESSION['USER']->email) {

            $arr['email'] = $data['email'];
            $row = $user->first($arr);

            if (
                $data['fullname'] == $row->fullname &&
                $data['phone'] == $row->phone &&
                $data['city'] == $row->city &&
                $data['address'] == $row->address
            ) {
                $user->errors['notchange'] = "This Informations are already updated.";
                $user->errors['flag'] = true;
                return $user->errors;
            }
        }

        if ($user->changeInfoValidate($data)) {

            $employee = new Employee;

            $arr['email'] = $data['email'];

            $row = $user->first($arr);
            $emprow = $employee->first($arr);

            if ((!empty($row) || !empty($emprow)) && $_SESSION['USER']->email != $data['email']) {
                // show($row);
                $user->errors['flag'] = true;
                $user->errors['email'] = "This email is alrady in use.";
                return $user->errors;
            }

            $user->update($id, $data, 'id');
            $_SESSION['USER']->fullname = $data['fullname'];

            // user email is changed then redirect to the sign in page 
            if ($_SESSION['USER']->email != $data['email']) {

                $all_users = new AllUsers;

                $user->update($id, ['email_verified' => 0], 'id');
                
                // change the chat for user table include that email
                $chatRow = $all_users->first(['email'=>$_SESSION['USER']->email]);
                
                if(!empty($chatRow )){
                    
                    $all_users->update($chatRow->id, ['email' => $data['email']], 'id');
                }

                $data = [];
                
                unset($_SESSION["USER"]);
                session_destroy();
                redirect('signin');
            } else {

                redirect('customer/profile');
            }
            // show($update);
        } else {
            return $user->errors;
        }
    }

    //  user chanage password
    private function changePassword($data, $id, $user)
    {
        if ($user->passwordResetValidate($data)) {

            $arr['id'] = $id;
            $row = $user->first($arr);

            // show($data);

            $checkpassword = password_verify($data['password'], $row->password);
            if ($checkpassword === true) {

                $hash = password_hash($data['confirm_password'], PASSWORD_DEFAULT);
                $update = $user->update($id, ['password' => $hash], 'id');

                $user->errors['flag'] = false;
                redirect("customer/profile");
                return $user->errors;
            } else {
                $user->errors['flag'] = true;
                $user->errors['password'] = "Invalid Current Password";
                return  $user->errors;
            }
        } else {
            return $user->errors;
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
                $user->update($id, ['user_image' => $new_img_name], 'id');
                redirect('customer/profile');
            } else {
                $fileError['flag'] = true;
                $fileError['error'] = "You can't upload files of '" . $img_ex_lc . " ' type !";
                // header("Location:../../signup.php?error=$em&$data");
                return $fileError;
            }
        }
    }
}
