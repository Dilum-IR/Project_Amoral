<?php

class Quotation extends Controller{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('customer/quotation');
    }
}