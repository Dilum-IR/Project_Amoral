<?php 

class Profile extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {

            $user = new User;

            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])){
                unset($_POST['save']);
                // show($_POST);
                $this->changeInfo($_POST,$_SESSION['USER']->id,$user);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveP'])) {

                unset($_POST['saveP']);
                $this->changePassword($_POST, $_SESSION['USER']->id, $user);
                //show($_POST);
            }

             // get the session user data for bind to the profile info
             $data = $this->userInfo($_SESSION['USER']->id, $user);


             // show($data);

            $this->view('customer/profile',$data);
       
        }else{
            redirect('home');
        }
    }

    private function userInfo($id,$user){

        $arr['id'] = $id;

        $row = $user->first($arr);

        unset($row->password);
        unset($row->id);
        
        $data = ['data' => $row];
        return $data;
        //show($row);

        // $emprow = $employee->first($arr);
    }

    //  user chanage info data
    private function changeInfo($data, $id, $user)
    {

        // show($data);

    }

    //  user chanage password
    private function changePassword($data, $id, $user)
    {

    }
}