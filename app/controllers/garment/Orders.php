<?php

class Orders extends Controller
{
    public function index()
    {
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == "garment") {

            $dumy = ["garment_id" => $_SESSION['USER']->emp_id];

            $id = $_SESSION['USER']->emp_id;

            // view the garment order details
            $garment_order = new GarmentOrder;

            $result = $garment_order->getGarmentOrderData();

            $data["data"] = $result;
            // show($data);


            // update the order status  
            if (isset($_POST['updateGorder'])) {

                $this->update_order($garment_order, $_POST);
            }

            // cancel the order
            if (isset($_POST['CancelGorder'])) {

                $arr['order_id'] = $_POST['order_id'];
                $id = $_POST['order_id'];

                // $arr['garment_id'] = $_POST['garment_id'];
                $result = $garment_order->first($arr);

                $garmentstatus = $result->status;

                if ($result) {
                    // show($result['placed_date']);
                    date_default_timezone_set('Asia/Kolkata');
                    $current_date = date("Y-m-d");

                    $placed_date = new DateTime($result->placed_date);
                    $fix_current_date = new DateTime($current_date);

                    $interval = $placed_date->diff($fix_current_date);

                    // Get the number of days
                    $days_difference = $interval->days;

                    if ($days_difference < 2 && $garmentstatus === 'pending') {

                        $garment_order->delete($id, 'order_id');
                    }
                }
                redirect('garment/orders');
            }


            $this->view('garment/orders', $data);
        } else {
            redirect('home');
        }
    }


    private function update_order($garment_order, $data)
    {
        show($data);

        $garment_id = $data['order_id'];

        $switch = $data['status'];

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
    public function save_reports()
    {
        if ($_SESSION['USER']->emp_status == "garment" && $_SESSION['USER']->emp_id == $_POST['garment_id']) {

            // use the how is the garment ? garment_id
            $report = new GarmentReport;

            if (isset($_POST['garment_id'])) {

                $report->insert($_POST);
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            redirect('404');
        }
    }
}
