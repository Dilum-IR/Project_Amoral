<?php

class GarmentOrders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;
        $garments = new Garment;

        if ($username != 'User') {

            $data['garment_orders'] = $order->get('employee', 'emp_id');
            $data['garments'] = $garments->findAll('garment_id');
            // show($data);
            
            $this->view('manager/garmentorders', $data);
              
        }else{
            redirect('home');
        }
    }
}