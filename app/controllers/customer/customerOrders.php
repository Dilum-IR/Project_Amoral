<?php

class CustomerOrders extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        // if ($username != 'User') {
            $this->view('customer/orders');
        // } else {
        //     redirect('home');
        // }
    }
}
