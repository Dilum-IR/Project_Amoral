<?php

class Orders extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        // if ($username != 'User') {

            $order = new Order;
            $user = new User;

            // find all delivery orders
            $result = $order->findAll('order_id');
            $allUsers = $user->findAll('id');

            // show($allUsers);
            // foreach ($result as $item) {

            //     foreach ($allUsers as $current) {

            //         if ($item->user_id ==  $current->id) {

            //             // $yourObject = new stdClass();

            //             // $yourObject->fullname = $current->fullname;
            //             // show($item);
            //             // echo $current->fullname;
            //             // $item["fullname"] = $yourObject;
            //             // $current->fullname;
            //         }
            //     }
            //     // $eachUsers = $user->where($dumy);
            //     // $result = $order->findAll('order_id');
            // }


            // show($result);
            $data = ['data' => $result];
            $this->view('delivery/orders', $data);
        // } else {
        //     redirect('home');
        // }
    }
}
