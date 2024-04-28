<?php

class Home extends Controller
{
    public function index()
    {

        if (isset($_SESSION['USER'])) {

            unset($_SESSION['USER']);
        }
        // session_destroy();
        // redirect('signin');

        // require_once 'Model.php';
        // echo "this is a home controller";

        //    $user = new User;
        //    $result= $user->findAll(); 

        // $arr['first_name'] = 'dilum';
        // $result= $model->where($arr);

        // $arr['fullname'] = 'thiran';
        // $arr['email'] = 'thiran@gmail.com';
        // $arr['password'] = '2536';
        // $result= $user->insert($arr);

        // $result= $model->delete(5);

        //    $arr['id'] = 2;
        //     $arr['first_email'] = 'thiran';

        //    show($result);

        if(isset($_POST["newMessage"])){
            unset($_POST["newMessage"]);
            // show($_POST);
            $this->addMessage($_POST);
            
        }

        $this->view('home/home');
    }


    public function addMessage($data)
    {
        // show($data);
        $contactUS = new ContactUs;

        $contactUS->insert($data);
    }
}
