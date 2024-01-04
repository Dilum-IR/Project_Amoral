<?php

class Profile extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {

            $employee = new Employee;

            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POSt['save'])){
                unset($_POST['save']);
                // show($_POST);
                $this->changeInfo($_POST,$_SESSION['USER']->emp_id,$employee);
            }
            
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POSt['saveP'])){
                unset($_POST['save']);
                // show($_POST);
                $this->changeInfo($_POST,$_SESSION['USER']->emp_id,$employee);
            }
            
            // get the session user data for bind to the profile info
            
            $data =$this->userInfo($_SESSION['USER']->emp_id,$employee);
            //show($data);
            $this->view('garment/profile');
            
       
        }else{
            redirect('home');
        }
    }
    // user still database include data

    private function userInfo($id,$employee){

        $arr['emp_id'] = $id;

        $row = $employee->first($arr);

        unset($row->password);
        unset($row->emp_id);

        $data = ['data' => $row];
        return $data;

        // show($row);

        //$emprow = $employee->first($arr);
    }

    //user change info data
    private function changeInfo($data,$id,$employee){

        //show($data);
    }

    //user change password

    private function changePassword($data ,$id,$employee){

    }

}
