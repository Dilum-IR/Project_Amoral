<?php

class CustomerDetails extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if($username != 'User' && $_SESSION['USER']->emp_status == 'merchandiser'){
            $customer = new User;

            $result = $customer->findAll_selectedColumn('id',$customer->customerColumns, );

            $data = ['data'=>$result];
            // show($result);

            //update customer details

            if(isset($_POST["cstUpdate"])){
                $id = $_POST['id'];

                unset($_POST['cstUpdate']);
                $arr = $_POST;

                if(isset($arr)){
                    // show($arr);
                    $update = $customer->update($id, $arr, 'id');
                    redirect('merchandiser/customerdetails');
                }

            }

            //add new customer

            if(isset($_POST['newCustomer'])){
                unset($_POST['newCustomer']);

                $this->customerAdd($_POST);
            }

            // remove customer
            if (isset($_POST["cstRemove"])) {

                $id = $_POST['id'];

                unset($_POST['cstRemove']);
                $arr = $_POST;
                $arr['is_active'] = 0;

                if (isset($arr)) {
                    // show($arr);
                    $update = $customer->update($id, $arr, 'id');
                    redirect('merchandiser/customerdetails');
                }
            }

            $this->view('merchandiser/customerdetails', $data);
        }else{
            redirect('home');
        }

        //remove customer

        // if(isset($_POST['']))



    }


    public function customerAdd($data){
        // show($data);
        $customer = new User;
        $employee = new Employee;

        $arr['email'] = $_POST['email'];
        $cstRow = $customer->first($arr);
        $empRow = $employee->first($arr);
        // $customer->insert($arr);

        if (!$cstRow && !$empRow) {
            // password hashing 
            // $password = $data['contact_number'];            
            $randomPassword = $this->generateRandomPassword(7);

            $hash = password_hash($randomPassword, PASSWORD_BCRYPT);

            $data['password'] = $hash;

            $customer->insert($data);

            // save user email in another table for chat with users
            $all_users = new AllUsers();
            $arr['email'] = $_POST['email'];
            $all_users->insert($arr);

            $sendmail = new SendMail;
            // emp_name or fullname
            $res = $sendmail->sendVerificationEmail($_POST['email'], $randomPassword, $_POST['fullname'], "pass");
        }

        redirect('merchandiser/customerdetails');
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