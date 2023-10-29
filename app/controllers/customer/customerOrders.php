<?php

class CustomerOrders extends Controller
{
    public function index()
    {
        // echo "this is a about controller";
        $this->view('customer/orders');
    }
}
