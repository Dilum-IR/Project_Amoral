<?php

class Quotation extends Controller{
    public function index()
    {
  
        $order = new Order;

        // show($_POST);
        if (isset($_POST['newQuotation'])){
            //need to validate
                unset($_POST['newQuotation']);
                $order->insert($_POST);
                redirect('customer/quotation');
        }

        $this->view('customer/quotation');
    }
}