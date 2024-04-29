<?php

class Home extends Controller
{
    public function index()
    {

        if (isset($_SESSION['USER'])) {

            unset($_SESSION['USER']);
        }
        // session_destroy();
        // redirect('signin');

        // require_once 'Model.php';
        // echo "this is a home controller";

        //    $user = new User;
        //    $result= $user->findAll(); 

        // $arr['first_name'] = 'dilum';
        // $result= $model->where($arr);

        // $arr['fullname'] = 'thiran';
        // $arr['email'] = 'thiran@gmail.com';
        // $arr['password'] = '2536';
        // $result= $user->insert($arr);

        // $result= $model->delete(5);

        //    $arr['id'] = 2;
        //     $arr['first_email'] = 'thiran';

        //    show($result);

        if(isset($_POST["newMessage"])){
            unset($_POST["newMessage"]);
            // show($_POST);
            $this->addMessage($_POST);
            
        }

        $this->checkDeliveredOrder();

        $this->view('home/home');
    }


    public function addMessage($data)
    {
        // show($data);
        $contactUS = new ContactUs;

        $contactUS->insert($data);
    }

    // function to update order status after 7 days of updating to delivered
    public function checkDeliveredOrder(){
        $order = new Order;
        $deliveredOrders = $order->where(['order_status' => 'delivered']);

        $currentTimestamp = time();
        $sevenDays = 60 * 60 * 24 * 7;


        if(empty($deliveredOrders)){
            return [];
        }
        
        foreach ($deliveredOrders as $deliveredOrder) {
            $orderTimestamp = strtotime($deliveredOrder->delivered_date);
            $diff = $currentTimestamp - $orderTimestamp;

            if($diff > $sevenDays){
                $order->update($deliveredOrder->order_id, ['order_status' => 'completed']);

            }
        }



    }

}
