<?php 

class Profile extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('customer/profile');
    }
}