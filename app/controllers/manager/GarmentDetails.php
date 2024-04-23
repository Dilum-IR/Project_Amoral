<?php

use LDAP\Result;

class GarmentDetails extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'manager') {

            $employee = new Employee;
            $garment = new Garment;

            $columnGarment = [];
            $columnGarment[0] = "garment.id";
            $columnGarment[1] = "garment.garment_id";
            $columnGarment[2] = "garment.day_capacity";
            $columnGarment[3] = "garment.no_workers";
            $columnGarment[4] = "garment.location";
            $columnGarment[5] = "garment.cut_price";
            $columnGarment[6] = "garment.sewed_price";

            $columnEmployee = [];

            $columnEmployee[0] = "employee.emp_name";
            $columnEmployee[1] = "employee.email";
            $columnEmployee[2] = "employee.address";
            $columnEmployee[3] = "employee.is_active";
            $columnEmployee[4] = "employee.contact_number";
            $columnEmployee[5] = "employee.DOB";
            $columnEmployee[6] = "employee.emp_id";
            $columnEmployee[7] = "employee.emp_status";
            $columnEmployee[8] = "employee.emp_id";

            $result = $employee->find_ActivewithInner(['emp_status' => 'garment'], "garment", "emp_id", "garment_id",);
            // $result2 = $employee->find_ActivewithInner(['emp_status' => 'garment'], "garment", "emp_id", "garment_id", $columnGarment);

            // $result =  $garment->findAll('garment_id');
            // $result = $garment->findAll_withInner("employee", "emp_id", "garment_id");

            $data = ['data' => $result];
            // $data2 = ['garment' => $result2];



            // show($data);

            //add new garment
            if (isset($_POST["newEmployee"])) {

                unset($_POST["newEmployee"]);

                $this->garmentAdd($_POST);
            }

            // update garment
            if (isset($_POST["empUpdate"])) {

                $emp_id = $_POST['emp_id'];

                unset($_POST['empUpdate']);
                $arr = $_POST;
                // $arr['is_active'] = 0;

                if (isset($arr)) {

                    // show($arr);
                    $update = $employee->update($emp_id, $arr, 'emp_id');
                    redirect('manager/garmentedetails');
                }
            }

            // remove garment

            if (isset($_POST["empRemove"])) {

                $emp_id = $_POST['emp_id'];

                unset($_POST['empRemove']);
                $arr = $_POST;
                $arr['is_active'] = 0;

                if (isset($arr)) {
                    // show($arr);
                    $update = $employee->update($emp_id, $arr, 'emp_id');
                    redirect('manager/garmentedetails');
                }
            }



            $this->view('manager/garmentdetails', $data);
        } else {
            redirect('home');
        }
    }


    public function garmentAdd($data)
    {
        show($data);
        $garment = new Garment;
        $user = new User;
        $employee = new Employee;

        $arr['email'] = $data['email'];


        $userRow = $user->first($arr);

        $empRow = $employee->first($arr);
        // $garment->insert($arr);





        if (!$userRow && !$empRow) {
            // password hashing 
            // $password = $data['contact_number'];            
            $randomPassword = $this->generateRandomPassword(7);

            $hash = password_hash($randomPassword, PASSWORD_BCRYPT);

            $data['password'] = $hash;

            // $employee->insert($emp);
            // $garment->insert($gmnt);

            // save user email in another table for chat with users
            $all_users = new AllUsers();
            $arr['email'] = $_POST['email'];
            $arr['emp_status'] = $_POST['email'];

            $all_users->insert($arr);

            $sendmail = new SendMail;
            $res = $sendmail->sendVerificationEmail($_POST['email'], $randomPassword, $_POST['emp_name'], "pass");
        }

        redirect('manager/garmentdetails');
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
}
