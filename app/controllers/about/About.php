<?php

class About extends Controller
{
    public function index()
    {
        // echo "this is a about controller";
        $this->view('about');

        $customer = new User();

        $data['id'] = 38; 

        // $data = $customer->findAll_withInner("orders","id","user_id");
        // $data = $customer->find_withInner($data,"orders","id","user_id");
        $data = $customer->find_withLOJ($data,"orders","id","user_id");
        show($data);
    }
} 

