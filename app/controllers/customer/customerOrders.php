<?php

class CustomerOrders extends Controller
{
    public function index()
    {
        

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        
        $order = new Order;
        
        if ($username != 'User') {
            
            $id = ['user_id' => $_SESSION['USER']->id];
            show($id);
            $data = $order->where($id);

            show($_POST);

            if (isset($_POST['updateOrder'])){
                $order_id = $_POST['order_id'];
                unset($_POST['total_price']);
                unset($_POST['updateOrder']);
                $arr = $_POST;
                if (isset($arr)){
                    show($arr);
                    $update = $order->update($order_id, $arr, 'order_id');
                    redirect('customer/orders');
                }
            }
            
            $this->view('customer/orders', $data);

            
            if (isset($_POST['report'])) {
        
                    $report = new CustomerReport;
                    

                    
                    unset($_POST['report']);

                    $_POST['user_id'] = $id['user_id'];
    
                    $_POST['report_date'] = date('Y-m-d');
                    
                    if (isset($_POST['user_id'])) {
                        $report->insert($_POST);
                        unset($_POST['user_id']);
                        redirect('customer/orders');
                        show($_POST);
                    }                
   
            }
        } else {
            redirect('home');
        }

    }

}
