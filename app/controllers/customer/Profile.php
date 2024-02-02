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
    }

    //  user chanage info data
    private function changeInfo($data, $id, $user)
    {
        if ($user->changeInfoValidate($data)) {

            show($data);
            $update = $user->update($id, $data, 'id');
            //echo $update;
            if ($update) {

                redirect('customer/profile');

            } else {

            }

        }

        // show($data);

    }

    //  user chanage password
    private function changePassword($data, $id, $user)
    {
        // if ($user->passwordResetValidate($data)) {

        //     $arr['id'] = $id;

        //     $row = $user->first($arr);

        //     show($user->errors);

        //     $checkpassword = password_verify($data['password'], $row->password);
        //     if ($checkpassword === true) {

        //         $hash = password_hash($data['confirm_password'], PASSWORD_DEFAULT);
        //         $update = $user->update($id, ['password' => $hash], 'id');
        //         // echo ("$update");
        //         // redirect("customer/profile");

        //         show($user->errors);

        //         return "success";


        //     } else {
        //         return "Invalid";
        //         //redirect("customer/profile");
        //         // echo ("Incorrect password");
        //     }


        // }

    }
}