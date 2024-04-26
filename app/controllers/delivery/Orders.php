<?php

class Orders extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status === 'delivery') {

            $emp_id = $_SESSION['USER']->emp_id;

            // if ($username != 'User') {

            $order = new Order;
            // find all delivery orders
            // $result = $order->where(['order_status'=>"delivering"]);

            $column_names = [];
            $column_names[0] = "users.fullname";
            $column_names[1] = "users.phone";
            $column_names[2] = "orders.order_id";
            $column_names[3] = "orders.city";
            $column_names[4] = "orders.order_status";
            $column_names[5] = "orders.dispatch_date";
            $column_names[6] = "orders.order_placed_on";
            $column_names[7] = "orders.latitude";
            $column_names[8] = "orders.longitude";
            $column_names[9] = "orders.deliver_id";
            $column_names[10]="users.address";
            $column_names[11]="orders.is_delivery";


            $result = $order->find_withInner(['order_status' => "delivering", 'deliver_id' => $emp_id,'is_delivery'=>"1"], "users", "user_id", "id", $column_names);

            
            $data['data1'] = $result;
            // show($data);
            // if (isset($_POST['confirm']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                //     unset($_POST['confirm']);
                //     $_POST['order_status'] = 'delivered';

                //     $order->update($_POST['order_id'], $_POST, 'order_id');
                //     redirect('delivery/orders');
                
                // }
                
                // show($_POST);
                
                
                
                
                // show($data);


            $this->view('delivery/orders', $data);
        } else {
            redirect('home');
        }

    }
    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];
            // show($_POST);

            $order = new Order;  // Assuming you create a new instance of the Order model

            // Prepare data for update
            $data = [
                'order_status' => $status  // Make sure the column name in your database is 'order_status'
            ];

            // Update the order status
            if ($order->update($orderId, $data, 'order_id')) {
                echo json_encode(['success' => true, 'message' => 'Order status updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update order status.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
        }
        exit;  // Ensure no further output is sent
    }
    
    


}
