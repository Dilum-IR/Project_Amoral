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
    }

}

