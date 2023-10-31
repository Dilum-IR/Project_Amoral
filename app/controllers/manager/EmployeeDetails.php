<?php

class EmployeeDetails extends Controller
{
    public function index()
    {

        // show($_POST);

        $employee = new Employee;

        
        $result=$employee->findAll('emp_id');

        $data=['data'=> $result];  
        // show($result);

        $this->view('manager/employeedetails',$data);
    }
}
