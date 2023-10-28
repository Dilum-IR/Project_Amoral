<?php

class CustomerOrders extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $order = new Order;
        $data = $order->findAll();

        // echo "this is a about controller";
        $this->view('customer/orders', $data);
    }
}
