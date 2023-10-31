<?php

class Orders extends Controller
{
    public function index()
    {
        
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User') {

            $dumy = ["garment_id" => $_SESSION['USER']->emp_id ?? 1];

            $id = $_SESSION['USER']->emp_id ?? 1;

            // echo $_SESSION['USER']->email;
            // view the garment order details
            $garment_order = new GarmentOrder;
            $order = new Order;

            $result = $garment_order->where($dumy);

            // $result2 = $garment_order->getOrdersDetails($dumy);
            // show($result2);
            // $orderDetails = $order->first($result);

            if ($result) {
                $data = ["data" => $result];
            }

            // update the order status  
            if (isset($_POST['updateGorder'])) {

                // show($_POST);

                $garment_id = $_POST['garment_id'];

                $switch = $_POST['status'];

                switch ($switch) {
                    case 'pending':
                        $arr['status'] = 'cutting';
                        break;
                    case 'cutting':
                        $arr['status'] = 'cutting done';
                        break;
                    case 'cutting done':
                        $arr['status'] = 'sewing';
                        break;
                    case 'sewing':
                        $arr['status'] = 'sewing done';
                        break;
                    case 'sewing done':
                        $arr['status'] = 'success';
                        break;
                    default:
                        break;
                }
                if (isset($arr)) {
                    $update = $garment_order->update($garment_id, $arr, 'garment_id');
                    redirect('garment/orders');
                }
            }

            // report problem
            // use the how is the garment ? garment_id
            if (isset($_POST['report'])) {

                $report = new GarmentReport;

                unset($_POST['report']);

                $_POST['garment_id'] = $id;

                if (isset($_POST['garment_id'])) {

                    $report->insert($_POST);
                    unset($_POST['garment_id']);
                    redirect('garment/orders');
                }
            }

            $this->view('garment/orders', $data);
        } else {
            redirect('home');
        }
    }
}
