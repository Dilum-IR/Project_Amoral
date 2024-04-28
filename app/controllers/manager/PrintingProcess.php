<?php

class PrintingProcess extends Controller{
    public function index(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == "manager") {
            $order = new Order;
            $order_material = new OrderMaterial;
            $customer = new User;
    
            $data['customers'] = $customer->findAll();
            $data['orders'] = $order->findAll_withLOJ('garment_order','order_id','order_id');
            $data['material_sizes'] = $order->getFullData();
            $data['printing_types'] = $order_material->findAll_withLOJ('printing_type','ptype_id','ptype_id');
            // show($data);
            $this->view('manager/printingprocess', $data);
        
        }
    }

    public function updateOrderStatus(){
        try{
            $arr = [];
            if (!isset($_POST) || $_SESSION['USER']->emp_status != "manager") {
                $arr['user'] = false;

                echo json_encode($arr);
                exit;
            }
            $order = new Order;
            // var_dump($_POST);
            $order->update($_POST['order_id'],['order_status' => $_POST['status']], 'order_id');
            if($_POST['status'] == 'sent to garment'){
                $garment_order = new GarmentOrder;
                $garment_order->update($_POST['garment_order_id'],['status' => 'sent to garment'], 'garment_order_id');
                // var_dump($x);
            }
            $arr['user'] = true;
            echo json_encode($arr);
        }catch(\Throwable $th){
            $arr['user'] = false;
            echo json_encode($arr);
        }
    }
}