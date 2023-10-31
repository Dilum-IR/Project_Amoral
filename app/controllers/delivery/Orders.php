<?php

class Orders extends Controller
{
    public function index()
    {
        $order = new Order;

        $result = $order->findAll('order_id');
        show($result);
        $data = ['data' => $result];

        $this->view('delivery/orders', $data);
        
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {
            
            $this->view('delivery/orders');
        }
        else{
            redirect('home');
        }

    }

}

