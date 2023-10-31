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

                    show($arr);
                    $update = $employee->update($emp_id, $arr, 'emp_id');
                    redirect('manager/employeedetails');
                    
                }
            }
    
            // Employee registration
            if (isset($_POST["newEmployee"])) {
            
                unset($_POST["newEmployee"]);
                $this->employeeAdd($_POST);

            }
        
            $result = $employee->findAll('emp_id');
            
            $data = ['data' => $result];
           
            $this->view('manager/employeedetails', $data);

        } else {
            redirect('home');
        }
        
        
    }
    
    
    public function employeeAdd($data){

        // show($data);

        $employee = new Employee;

        $arr['email'] = $_POST['email'];
        $row = $employee->first($arr);

        // show($row);

        if(!$row){

            // password hashing 
			$password = $data['contact_number'];
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$data['password']= $hash;

            // show($data);
            $employee->insert($data);

        }



    
        // redirect("manager/employeedetails");
    }
}
