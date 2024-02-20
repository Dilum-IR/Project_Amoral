<?php

class Quotation extends Controller{

    public function index(){

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;
        $quotation_reply = new QuotationReply;
        $materials = new MaterialStock;
        $users = new User;

        if($username != 'User'){
            $id = ['user_id' => $_SESSION['USER']->id];

            $data['quotation'] = $order->getUserData();
            // show($data['quotation']);
            $data['material_sizes'] = $order->getFullData();
            $data['quotation_reply'] = $quotation_reply->get("orders", "order_id");	
            $data['materials'] = $materials->getMaterialNames();
            $data['users'] = $users->findAll();
            // show($data['users']);

            $this->view('manager/quotation', $data);

            if(isset($_POST['reply'])){
                unset($_POST['reply']);

                date_default_timezone_set('Asia/Kolkata');
                $current_date = date("Y-m-d");

                $arrReply = [
                    'order_id' => $_POST['order_id'],
                    'replyed_date' => $current_date,
                    'emp_id' => $id['user_id'],
                    'special_note' => $_POST['special_note'],
                    'user_id' => $_POST['user_id']
                ];

                $arrOrder = [
                    'order_id' => $_POST['order_id'],
                    'order_status' => 'reply',
                    'unit_price' => $_POST['unit_price'],
                    'discount' => $_POST['discount']
                
                ];

                $quotation_reply->insert($arrReply);
                $order->update( $_POST['order_id'], $arrOrder , 'order_id');
                redirect('manager/quotation');
            }
            
        }
    }
}