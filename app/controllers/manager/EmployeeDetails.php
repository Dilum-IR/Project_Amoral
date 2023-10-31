<?php

class EmployeeDetails extends Controller
{
    public function index()
    {

        // show($_POST);

        $employee = new Employee;

        if(isset($_POST["empUpdate"])){
            $emp_id = $_POST['emp_id'];

            unset($_POST['empUpdate']);
            $arr = $_POST;
            if(isset($arr)){
                show($arr);
                $update = $employee->update($emp_id, $arr, 'emp_id');
                redirect('manager/employeedetails');
            }
        }

        // show($_POST);
        if(isset($_POST["newEmployee"])){
            unset($_POST["newEmployee"]);
            $employee->insert($_POST);
            redirect("manager/employeedetails");
        }

        if(isset($_POST["remove_emp"])){

            $id = $_POST["emp_id"];

            $employee->delete($id,'emp_id');
            // show($_POST);
            redirect('manager/employeedetails');
        }

        $result=$employee->findAll('emp_id');

        $data=['data'=> $result];  
        // show($result);

        $this->view('manager/employeedetails',$data);
    }
}
