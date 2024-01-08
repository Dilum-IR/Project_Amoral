<?php

class Quotation extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        // if ($username != 'User') {

            $order = new Order;

            if (isset($_POST['newQuotation'])) {
                //need to validate
                unset($_POST['newQuotation']);
                $_POST['user_id'] = $_SESSION['USER']->id;
                $_POST['order_status'] = "quotation";
                
                show($_POST);
                $order->insert($_POST);
                redirect('customer/quotation');
            }

            $this->view('customer/quotation');
            
        // } else {
        //     redirect('home');
        // }
    }
}
