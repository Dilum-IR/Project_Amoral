<?php

class Quotation extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {

            $order = new Order;

            // show($_POST);
            if (isset($_POST['newQuotation'])) {
                //need to validate
                unset($_POST['newQuotation']);
                $order->insert($_POST);
            }

            $this->view('customer/quotation');
        } else {
            redirect('home');
        }
    }
}
