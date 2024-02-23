<?php

class EmployeeDetails extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {

            $employee = new Employee;

            $result = $employee->findAll('emp_id');

            $data = ['data' => $result];
            // show($result);

            // update employee details
            if (isset($_POST["empUpdate"])) {

                $emp_id = $_POST['emp_id'];

                unset($_POST['empUpdate']);
                $arr = $_POST;

                if (isset($arr)) {

                    // show($arr);
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

            $result = $employee->findAll('emp_id');

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

        if (isset($_POST["remove_emp"])) {

            $id = $_POST["emp_id"];

            $employee->delete($id, 'emp_id');
            // show($_POST);
            redirect('manager/employeedetails');
        }

        $result = $employee->findAll('emp_id');
    }


    public function employeeAdd($data)
    {
        $employee = new Employee;
        $user = new User;

        $arr['email'] = $_POST['email'];
        $empRow = $employee->first($arr);
        $userRow = $user->first($arr);

        if (!$empRow && !$userRow) {
            // password hashing 
            // $password = $data['contact_number'];            
            $randomPassword = $this->generateRandomPassword(7);

            $hash = password_hash($randomPassword, PASSWORD_BCRYPT);

            $data['password'] = $hash;

            $employee->insert($data);

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
}
