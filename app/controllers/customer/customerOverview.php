<?php
class CustomerOverview extends Controller
{
    public function index()
    {
 
        // if ($username != 'User') {

            $this->view('customer/overview');
        // }else{
        //     redirect('home');
        // }
    }
}
