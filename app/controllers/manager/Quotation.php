<?php

class Quotation extends Controller{

    public function index(){

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $order = new Order;
        $quotation_reply = new QuotationReply;
        $materials = new MaterialStock;


        if($username != 'User'){
            $data['quotation'] = $order->findAll("order_id");
            $data['material_sizes'] = $order->getFullData();
            $data['quotation_reply'] = $quotation_reply->get("orders", "order_id");	
            $data['materials'] = $materials->getMaterialNames();


            $this->view('manager/quotation', $data);
        }
    }
}