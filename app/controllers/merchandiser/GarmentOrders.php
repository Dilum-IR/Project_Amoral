<?php

class GarmentOrders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;
        $garments = new Garment;
        $order_material = new OrderMaterial;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'merchandiser') {

            // $data['garment_orders'] = $order->get('employee', 'emp_id');
            $data['garments'] = $garments->findAll_withLOJ("employee", "garment_id", "emp_id");
            $data['order_material'] = $order_material->findAll('order_id');
            $data['material_sizes'] = $order->getMaterialData();
            
            $data['garment_orders'] = $order->findAll_withLOJ("garment", "garment_id", "garment_id");
            $data['customer_orders'] = $order->findAll_withLOJ("orders", "order_id", "order_id");
            // show($data['customer_orders']);
            
            $this->view('merchandiser/garmentorders', $data);
              
        }else{
            redirect('home');
        }
    }

    public function setDeadlines(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'merchandiser') {
            if (isset($_POST['garment_order_id'], $_POST['cut_dispatch_date'], $_POST['sew_dispatch_date'])) {
                $order->update($_POST['garment_order_id'],[
                    "cut_dispatch_date" => $_POST['cut_dispatch_date'], 
                    "sew_dispatch_date" => $_POST['sew_dispatch_date']
                ], 'garment_order_id');
            } 
        }
    }

    public function updateOrder(){
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new GarmentOrder;

        if ($username != 'User' && $_SESSION['USER']->emp_status == 'merchandiser') {
            if (isset($_POST['garment_order_id'], $_POST['cut_dispatch_date'], $_POST['sew_dispatch_date'])) {
                $order->update($_POST['garment_order_id'],[
                    "cut_dispatch_date" => $_POST['cut_dispatch_date'], 
                    "sew_dispatch_date" => $_POST['sew_dispatch_date']
                ], 'garment_order_id');
            } 
        }
    }

}