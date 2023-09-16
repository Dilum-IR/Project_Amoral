<?php

class Home extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        // echo "this is a home controller";

        $this->view('home/home');

    }
}

