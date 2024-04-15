<?php

class Overview extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;



        // if ($username != 'User') {

        $order = new Order;
        // find all delivery orders
        // $result = $order->where(['order_status'=>"delivering"]);


        // Use an array to specify multiple statuses
        // $statusesDelivering = ["delivering"];
        // $statusesDelivered = ["delivered"];


        $column_names = [];
        $column_names[0] = "users.fullname";
        $column_names[1] = "users.phone";
        $column_names[2] = "users.address";
        $column_names[3] = "orders.city";
        $column_names[4] = "orders.order_status";
        $column_names[5] = "orders.dispatch_date";
        $column_names[6] = "orders.order_placed_on";
        $column_names[7] = "orders.latitude";
        $column_names[8] = "orders.longitude";
        $column_names[9] = "orders.order_id";


        $result = $order->find_withInner(['order_status' => "delivering"], "users", "user_id", "id", $column_names);
        $result2 = $order->find_withInner(['order_status' => "delivered"], "users", "user_id", "id", $column_names);
        $data['delivering'] = $result;
        $data['delivered'] = $result2;

        // show($data);

        $this->view('delivery/overview', $data);


    }
}
