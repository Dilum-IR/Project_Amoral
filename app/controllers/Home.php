<?php

class Home extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        // echo "this is a home controller";

        $model = new Model;
        $model->test();

        $this->view('home/home');

    }
}

