<?php

class Quotation extends Controller{

    public function index(){

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;

        if($username != 'User'){
            $data['quotation'] = $order->findAll("order_id");
            $this->view('manager/quotation', $data);
        }
    }
}