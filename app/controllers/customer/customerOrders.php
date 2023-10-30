<?php

class CustomerOrders extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        $order = new Order;
        $data = $order->findAll();
        // if ($username != 'User') {
            $this->view('customer/orders', $data);
        // } else {
        //     redirect('home');
        // }

    }
}
