<?php

class CustomerOrders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;
        $materials = new MaterialStock;
        $order_material = new OrderMaterial;

        if ($username != 'User') {

            $data['orders'] = $order->findAll('order_id');
            $data['material_sizes'] = $order->getFullData();
            $data['materials'] = $materials->getMaterialNames();
            
            $this->view('manager/customerorders', $data);
              
        }else{
            redirect('home');
        }
    }
}