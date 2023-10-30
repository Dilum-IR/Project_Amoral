<?php

class Orders extends Controller
{
    public function index()
    {
        $dumy = ["garment_id" => 1];

        $garment_order = new GarmentOrder;
        $order = new Order;
        
        $result = $garment_order->where($dumy);
        // $result2 = $garment_order->getOrdersDetails($dumy);

        // show($result2);
        // $orderDetails = $order->first($result);

        $data = [ "data" => $result ];
        // $data = [
        //     'title1'=> "dsfgfsg",
        //     'title2'=> "dsfgfsg",
        //     'title3'=> "dsfgfsg",
        // ];

        // show($data["data"][0]);


        $this->view('garment/orders', $data);
    }
}
