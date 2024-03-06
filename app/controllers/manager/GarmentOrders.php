<?php

class GarmentOrders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;
        $garments = new Garment;
        $order_material = new OrderMaterial;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'manager') {

            // $data['garment_orders'] = $order->get('employee', 'emp_id');
            $data['garments'] = $garments->findAll('garment_id');
            $data['order_material'] = $order_material->findAll('order_id');
            $data['material_sizes'] = $order->getMaterialData();
            
            $data['garment_orders'] = $order->findAll_withLOJ("garment", "garment_id", "garment_id");
            $data['customer_orders'] = $order->findAll_withLOJ("orders", "order_id", "order_id");
            // show($data);
            
            $this->view('manager/garmentorders', $data);
              
        }else{
            redirect('home');
        }
    }

    public function assignGarment(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'manager') {
            foreach($_POST['garments'] as $garment){
                $data['garment_id'] = $garment['garment_id'];
                $data['status'] = 'assigned';
                if(!empty($garment['orders'])){
                    foreach($garment['orders'] as $customer_order){
                        $order->update($customer_order['id'], $data, 'garment_order_id');
                    }
                }
            }
        }
    }
}