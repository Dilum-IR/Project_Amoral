<?php

class PrintingProcess extends Controller{
    public function index(){
        $order = new Order;
        $order_material = new OrderMaterial;
        $customer = new User;

        $data['customers'] = $customer->findAll();
        $data['orders'] = $order->where(['order_status' => 'cut', 'order_status' => 'printing']);
        $data['material_sizes'] = $order->getFullData();
        $data['printing_types'] = $order_material->findAll_withLOJ('printing_type','ptype_id','ptype_id');
        // show($data);
        $this->view('manager/printingprocess', $data);
    }
}