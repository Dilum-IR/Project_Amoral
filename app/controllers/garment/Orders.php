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

            $result = $this->get_order_data($garment_order);
            $data["data"] = $result;
            // show($data);


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


    private function get_order_data($garment_order)
    {
        $result = $garment_order->getGarmentOrderData();
        $i = 0;

        foreach ($result as $item) {

            $qty = 0;
            $qty += $item->xs + $item->small + $item->medium + $item->large + $item->xl + $item->xxl;
            $item->qty = $qty;
            $item->id = $i;

            // initially included data pass to the array
            $item->mult_order = [
                [
                    "material_type" => $item->material_type,
                    "type" => $item->type,
                    "printing_type" => $item->printing_type,
                    "xs" => $item->xs,
                    "small" => $item->small,
                    "medium" => $item->medium,
                    "large" => $item->large,
                    "xl" => $item->xl,
                    "xxl" => $item->xxl,
                    "qty" => $item->qty,
                ]
            ];
            $i++;
        }

        $j = 0;


        // find the same order id orders and merge that orders 
        // include : material ,sizes with more data
        foreach ($result as $item) {

            foreach ($result as $key => $value) {

                if ($item->id != $value->id && $item->order_id == $value->order_id) {

                    $new_mult = [
                        "material_type" => $value->material_type,
                        "type" => $value->type,
                        "printing_type" => $value->printing_type,
                        "xs" => $value->xs,
                        "small" => $value->small,
                        "medium" => $value->medium,
                        "large" => $value->large,
                        "xl" => $value->xl,
                        "xxl" => $value->xxl,
                        "qty" => $value->qty,
                    ];

                    $item->mult_order = array_merge($item->mult_order, [$new_mult]);

                }
                $j++;
            }
        }

        $new_result = [];
        $id_array = [];

        foreach($result as $item) {

            if (!in_array( $item->order_id,$id_array)) {

                array_push($id_array, $item->order_id);
                array_push($new_result, $item);
            }
        }

        // show($id_array);


        // remove order elements
        for ($i = 0; $i < count($result); $i++) {

            unset($new_result[$i]->material_type);
            unset($new_result[$i]->printing_type);
            unset($new_result[$i]->type);
            unset($new_result[$i]->xs);
            unset($new_result[$i]->small);
            unset($new_result[$i]->medium);
            unset($new_result[$i]->large);
            unset($new_result[$i]->xl);
            unset($new_result[$i]->xxl);
            unset($new_result[$i]->qty);
            unset($new_result[$i]->unit_price);
            unset($new_result[$i]->material_id);
            unset($new_result[$i]->ptype_id);
            unset($new_result[$i]->sleeve_id);
            unset($new_result[$i]->placed_date);
            unset($new_result[$i]->emp_id);
        }

        // $resultArray = array_merge($result, $new_result);

        // show($new_result);

        return $new_result;
    }

    public function update_status()
    {
        try {

            $arr = [];
            if (!isset($_POST['garment_id']) || $_SESSION['USER']->emp_status != "garment" || $_SESSION['USER']->emp_id != $_POST['garment_id']) {
                $arr['user'] = false;

                echo json_encode($arr);
                exit;
            }

            $garment_order = new GarmentOrder;
            $order = new Order;

            // show($_POST);

            $garment_id = $_POST['garment_order_id'];
            $order_id = $_POST['order_id'];

            unset($_POST['garment_id']);
            unset($_POST['garment_order_id']);
            unset($_POST['order_id']);

            $switch = $_POST['status'];
            $arr['order_status'] = $_POST['status'];

            switch ($switch) {
                case 'pending':
                    break;
                case 'cutting':
                    break;
                case 'cut':
                    $order->update($order_id, $arr, 'order_id');
                    // $_POST['status'] = "";
                    break;
                case 'sent to company':
                    // $order->update($order_id, $arr, 'order_id');
                    // $_POST['status'] = "";
                    break;
                case 'company process':
                    // $order->update($order_id, $arr, 'order_id');
                    // $_POST['status'] = "";
                    break;
                case 'sent to garment':
                    // $order->update($order_id, $arr, 'order_id');
                    // $_POST['status'] = "";
                    break;
                case 'returned':
                    // $order->update($order_id, $arr, 'order_id');
                    // $_POST['status'] = "";
                    break;
                case 'sewing':
                    $order->update($order_id, $arr, 'order_id');
                    break;
                case 'sewed':
                    $order->update($order_id, $arr, 'order_id');
                    break;
                case 'completed':
                    // $order->update($order_id, $arr, 'order_id');
                    break;
                default:
                    break;
            }


            // status update
            $garment_order->update($garment_id, $_POST, 'garment_order_id');

            $arr['user'] = true;
            echo json_encode($arr);
        } catch (\Throwable $th) {
            $arr['user'] = false;

            echo json_encode($arr);
            exit;
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
