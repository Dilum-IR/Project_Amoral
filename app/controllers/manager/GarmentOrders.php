<?php

class GarmentOrders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;

        if ($username != 'User') {

            $data = $order->get('employee', 'emp_name', 'emp_id');
            
            $this->view('manager/garmentorders', $data);
              
        }else{
            redirect('home');
        }
    }
}