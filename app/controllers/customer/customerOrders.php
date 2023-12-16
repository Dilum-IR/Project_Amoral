<?php

class CustomerOrders extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        
        $order = new Order;
        
        if ($username != 'User') {
            
            $id = ['user_id' => $_SESSION['USER']->id];
            $data = $order->where($id);

            // show($data);

            if (isset($_POST['updateOrder'])){
                $order_id = $_POST['order_id'];
                
                unset($_POST['updateOrder']);
                $arr = $_POST;
                if (isset($arr)){
                    show($arr);
                    $update = $order->update($order_id, $arr, 'order_id');
                    redirect('customer/orders');
                }
            }
            
            $this->view('customer/orders', $data);
        } else {
            redirect('home');
        }

    }
}
