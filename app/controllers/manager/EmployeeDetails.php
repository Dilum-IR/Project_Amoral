<?php

class EmployeeDetails extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {
            
            // show($_POST);
    
            $employee = new Employee;
    
            
            $result=$employee->findAll('emp_id');
    
            $data=['data'=> $result];  
            // show($result);
    
            $this->view('manager/employeedetails',$data);
       
        }else{
            redirect('home');
        }

    }
}
