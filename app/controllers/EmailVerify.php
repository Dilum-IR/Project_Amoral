<?php

class EmailVerify extends Controller
{
    public function index()
    {


        if (isset($_SESSION['USER'])) {

            unset($_SESSION['USER']);
        } 

        $this->view('utils/emailVerify');
    }
}
