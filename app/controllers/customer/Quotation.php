<?php

class Quotation extends Controller{
    public function index()
    {
        $order = new Order;

        if (isset($_POST['newQuotation'])){
            //need to validate

                show($_POST['newQuotation']);

                $order->insert($_POST);
        }

        $this->view('customer/quotation');
    }
}