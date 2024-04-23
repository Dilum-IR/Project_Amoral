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
            $data['garments'] = $garments->findAll_withLOJ("employee", "garment_id", "emp_id");
            $data['order_material'] = $order_material->findAll('order_id');
            $data['material_sizes'] = $order->getMaterialData();
            
            $data['garment_orders'] = $order->findAll_withLOJ("garment", "garment_id", "garment_id");
            $data['customer_orders'] = $order->findAll_withLOJ("orders", "order_id", "order_id");
            // show($data['customer_orders']);
            
            $this->view('manager/garmentorders', $data);
              
        }else{
            redirect('home');
        }
    }

    public function assignGarment(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;
        $order_material = new OrderMaterial;
        $stock = new MaterialStock;

        // $response = [];
        if ($username != 'User' && $_SESSION['USER']->emp_status == 'manager') {
            // show($_POST);
            foreach($_POST['garments'] as $garment){
                $data['garment_id'] = $garment['garment_id'];

                

                if(!empty($garment['orders'])){
                    foreach($garment['orders'] as $customer_order){
                        $material_orders = $order_material->where(['order_id' => $customer_order['customer_orderId']]);
                        $materials = [];
                        foreach($material_orders as $material_order){
                            $materials[$material_order->material_id] = $material_order->xs + $material_order->small + $material_order->medium + $material_order->large + $material_order->xl + $material_order->xxl;
                        }
                        $response['materials'] = $materials;
                        $keys = array_keys($materials);
                        if(!is_array($keys)){
                                $keys = [$keys];
                        }
                        foreach($keys as $key){
                            $current = $stock->where(['stock_id' => $key]);
                            $updated = floatval($current[0]->quantity) - floatval(intval($materials[$key]) * (1/intval($current[0]->ppm)));
                            // show($updated);
                            $updated = number_format($updated, 2);
                            // $response['updated'][] = $updated;
                            $stock->update($key, ['quantity' => $updated], 'stock_id');
                        } 
                        $order->update($customer_order['id'], $data, 'garment_order_id');
                    }
                }
            }

            

        }
        // echo json_encode($response);
    }

    public function setDeadlines(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'manager') {
            if (isset($_POST['garment_order_id'], $_POST['cut_dispatch_date'], $_POST['sew_dispatch_date'])) {
                $order->update($_POST['garment_order_id'],[
                    "cut_dispatch_date" => $_POST['cut_dispatch_date'], 
                    "sew_dispatch_date" => $_POST['sew_dispatch_date']
                ], 'garment_order_id');
            } 
        }
    }

}