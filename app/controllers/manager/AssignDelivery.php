<?php

class AssignDelivery extends Controller{
    public function index(){
        $order = new Order();
        $employee = new Employee;
        $deliveryman = new Deliveryman;
        $order_material = new OrderMaterial;

        $data['orders'] = $order->where(['order_status' => 'sewed', 'is_delivery' => 1]);
        $data['sizes'] = $order_material->findAll();
        $data['deliveryman'] = $deliveryman->findAll_withLOJ('employee','emp_id','emp_id');
        // show($data);
        $this->view('manager/assigndelivery', $data);
    }

    public function assignDelivery(){
        
    }
}