<?php

class Profile extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {

            $employee = new Employee;


            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {

                unset($_POST['save']);
                // show($_POST);
                $this->changeInfo($_POST, $_SESSION['USER']->emp_id, $employee);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveP'])) {

                unset($_POST['saveP']);
                $this->changePassword($_POST, $_SESSION['USER']->emp_id, $employee);
                //show($_POST);
            }

            // get the session user data for bind to the profile info
            $data = $this->userInfo($_SESSION['USER']->emp_id, $employee);


            // show($data);

            $this->view('delivery/profile',$data);

        } else {
            redirect('home');
        }

    }

    //  user still database include data 
    private function userInfo($id, $employee)
    {
        $arr['emp_id'] = $id;

        $row = $employee->first($arr);

        unset($row->password);
        unset($row->emp_id);
        
        $data = ['data' => $row];
        return $data;
        // show($row);

        // $emprow = $employee->first($arr);



    }
    //  user chanage info data
    private function changeInfo($data, $id, $employee)
    {

        // show($data);

    }

    //  user chanage password
    private function changePassword($data, $id, $employee)
    {

    }

}
