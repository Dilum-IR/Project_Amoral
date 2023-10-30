<?php

class EmployeeDetails extends Controller
{
    public function index()
    {

        show($_POST);

        
        $this->view('manager/employeedetails');
    }
}
