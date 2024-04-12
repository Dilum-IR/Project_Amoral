<?php

class CustomerDetails extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if($username != 'User' && $_SESSION['USER']->emp_status == 'manager'){
            $customer = new User;

            $result = $customer->findAll_selectedColumn('id',$customer->customerColumns);

            $data = ['data'=>$result];
            // show($result);

            

            $this->view('manager/customerdetails', $data);
        }else{
            redirect('home');
        }

    }
}