<?php

class EmployeeDetails extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'manager') {

            $employee = new Employee;


            $result = $employee->findAllActive_withLOJ('deliveryman', 'emp_id', 'emp_id');
            // $result = $employee->findAllActive('emp_id');
            // show($result);
            $data = ['data' => $result];


            // update employee details
            if (isset($_POST["empUpdate"])) {

                $emp_id = $_POST['emp_id'];

                unset($_POST['empUpdate']);
                $arr = $_POST;
                // $arr['is_active'] = 0;

                if (isset($arr)) {

                    // show($arr);
                    // show($emp_id);
                    $update = $employee->update($emp_id, $arr, 'emp_id');
                    redirect('manager/employeedetails');
                }
            }

            // Employee registration
            if (isset($_POST["newEmployee"])) {
                // show($_POST);
                unset($_POST["newEmployee"]);

                $this->employeeAdd($_POST);
            }

            //remove employee
            if (isset($_POST["empRemove"])) {

                $emp_id = $_POST['emp_id'];

                unset($_POST['empRemove']);
                $arr = $_POST;
                $arr['is_active'] = 0;

                if (isset($arr)) {
                    // show($arr);
                    $update = $employee->update($emp_id, $arr, 'emp_id');
                    redirect('manager/employeedetails');
                }
            }

            $result = $employee->findAllActive('emp_id');

            $data = ['data' => $result];

            $this->view('manager/employeedetails', $data);
        } else {
            redirect('home');
        }



        // show($_POST);
        // if (isset($_POST["newEmployee"])) {
        //     unset($_POST["newEmployee"]);
        //     $employee->insert($_POST);
        //     redirect("manager/employeedetails");
        // }



        
    }


    public function employeeAdd($data)
    {
        // show($data);
        $employee = new Employee;
        $user = new User;

        $arr['email'] = $_POST['email'];
        $empRow = $employee->first($arr);
        $userRow = $user->first($arr);
        // show($userRow);

        if (!$empRow && !$userRow) {
            // password hashing 
            // $password = $data['contact_number'];            
            $randomPassword = $this->generateRandomPassword(7);

            $hash = password_hash($randomPassword, PASSWORD_BCRYPT);

            $data['password'] = $hash;

            $newImageName = $this->changeImage($data);
            // show($newImageName);


            if ($data['emp_status'] == 'garment') {
                $removingKeys = ['cut_price', 'sewed_price', 'no_workers', 'day_capacity', 'emp_image'];
                foreach ($removingKeys as $key) {
                    $columnGarment[$key] = $data[$key];
                    unset($data[$key]);
                }
            } else if($data['emp_status'] == 'delivery'){
                $removingKeysD = ['vehicle_type', 'max_capacity', 'vehicle_number'];
                foreach ($removingKeysD as $key) {
                    
                    $columnDelivery[$key] = $data[$key];
                    unset($data[$key]);
                }
            }

            $removeImage = ['emp_image'];
            foreach ($removeImage as $key) {
                // $columnImage[$key] = $data[$key];
                unset($data[$key]);
            }

            $data['emp_image'] = $newImageName;

            // show($data);
    
            $employee->insert($data);


            // show($data['emp_status']);
            if ($data['emp_status'] == 'garment') {
                //    show($data);

                $employee = new Employee;

                $result = $employee->findAllActive('emp_id');
                // show($result);
                $garment = new Garment;
                $newEmp['email'] = $data['email'];
                $empResult = $employee->first($newEmp);
                // show($empResult->emp_id);
                // show($data['city']);

                $columnGarment['garment_id'] = $empResult->emp_id;
                $columnGarment['location'] = $data['city'];

                // show($columnGarment);
                $garment->insert($columnGarment);
            }

            if ($data['emp_status'] == 'delivery') {
                //    show($data);

                $employee = new Employee;

                $result = $employee->findAllActive('emp_id');
                // show($result);
                $delivery = new Deliveryman;
                $newEmp['email'] = $data['email'];
                $empResult = $employee->first($newEmp);
                // show($empResult->emp_id);
                // show($data['city']);

                $columnDelivery['emp_id'] = $empResult->emp_id;

                // show($columnDelivery);

                // $columnDelivery['vehicle_type'] = toLowerCase()
               
                // show($columnDelivery);
                $$delivery->insert($columnDelivery);
            }

            // save user email in another table for chat with users
            $all_users = new AllUsers();
            $arr['email'] = $_POST['email'];
            $all_users->insert($arr);

            $sendmail = new SendMail;
            $res = $sendmail->sendVerificationEmail($_POST['email'], $randomPassword, $_POST['emp_name'], "pass");
        }

        redirect("manager/employeedetails");
    }

    function generateRandomPassword($length = 8)
    {
        //  password for used characters
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*-=+';

        // At least one character from each category
        $password = $uppercase[mt_rand(0, strlen($uppercase) - 1)];
        $password .= $lowercase[mt_rand(0, strlen($lowercase) - 1)];
        $password .= $numbers[mt_rand(0, strlen($numbers) - 1)];
        $password .= $specialChars[mt_rand(0, strlen($specialChars) - 1)];

        // Fill the remaining length with random characters
        $remainingLength = $length - 4;
        $allChars = $uppercase . $lowercase . $numbers . $specialChars;
        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $allChars[mt_rand(0, strlen($allChars) - 1)];
        }

        // Shuffle the password to make the order of characters
        $password = str_shuffle($password);

        return $password;
    }

    function changeImage($data)
    {

        // show($data);

        $img_name = $_FILES['emp_image']['name'];
        $tmp_name = $_FILES['emp_image']['tmp_name'];
        $error = $_FILES['emp_image']['error'];

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
                $new_img_name =  $data['email'] . "." . $img_ex_lc;

                // bind the change user image for session variable
                $data['emp_image'] = $new_img_name;

                // creating upload path on root directory
                $img_upload_path = "../../project_Amoral/public/uploads/profile_img/Employee/" . $new_img_name;

                // move upload image for that folder
                move_uploaded_file($tmp_name, $img_upload_path);

                //update the databse image name
                // $user->update($id, ['user_image' => $new_img_name], 'id');
                // redirect('customer/profile');
                return $new_img_name;
            } else {
                $fileError['flag'] = true;
                $fileError['error'] = "You can't upload files of '" . $img_ex_lc . " ' type !";
                // header("Location:../../signup.php?error=$em&$data");
                return $fileError;
            }
        }
    }
}
