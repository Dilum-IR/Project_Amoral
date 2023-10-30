<?php

class Quotation extends Controller{
    public function index()
    {
        $order = new Order;

        // show($_POST);
        if (isset($_POST['newQuotation'])){
            //need to validate
                

                // $order->insert($_POST);
        }

        $this->view('customer/quotation');
    }
}