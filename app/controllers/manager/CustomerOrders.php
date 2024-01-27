<?php

class CustomerOrders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;

        if ($username != 'User') {

            $data = $order->findAll('order_id');
            
            $this->view('manager/customerorders', $data);
              
        }else{
            redirect('home');
        }
    }
}