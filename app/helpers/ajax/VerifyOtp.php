<?php
include '../../models/User.php';
include '../../models/Employee.php';

if (isset($_POST) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $VerifyOtp = new VerifyOtp();

    $response = $VerifyOtp->VefityData($_POST);

    echo $response;
}


class VerifyOtp {

    public function VefityData($data){
        $user = new User;
        $employee = new Employee;

        if ($user->first($data->email)) {
    
            return "valid";
    
        } else if ($employee->first($data->email)) {
        }
    }
}