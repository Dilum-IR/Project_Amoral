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

                    // remove the merge data value part included object 
                    unset($result[$j]);
                }
                $j++;
            }
        }

        // remove order elements
        for ($i = 0; $i < count($result); $i++) {

            unset($result[$i]->material_type);
            unset($result[$i]->printing_type);
            unset($result[$i]->type);
            unset($result[$i]->xs);
            unset($result[$i]->small);
            unset($result[$i]->medium);
            unset($result[$i]->large);
            unset($result[$i]->xl);
            unset($result[$i]->xxl);
            unset($result[$i]->qty);
            unset($result[$i]->unit_price);
            unset($result[$i]->material_id);
            unset($result[$i]->ptype_id);
            unset($result[$i]->sleeve_id);
            unset($result[$i]->placed_date);
            unset($result[$i]->emp_id);
        }

        // $resultArray = array_merge($result, $new_result);

        // show($result);
        return $result;
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

            // show($_POST);

            $garment_id = $_POST['garment_order_id'];

            $switch = $_POST['status'];

            switch ($switch) {
                case 'pending':
                    $_POST['status'] = 'cutting';
                    break;
                case 'cutting':
                    $_POST['status'] = 'cutting done';
                    break;
                case 'cutting done':
                    $_POST['status'] = 'sewing';
                    break;
                case 'sewing':
                    $_POST['status'] = 'sewing done';
                    break;
                case 'sewing done':
                    $_POST['status'] = 'success';
                    break;
                default:
                    break;
            }

            echo json_encode($_POST);

            // if (isset($arr)) {
            //     $update = $garment_order->update($garment_id, $arr, 'garment_id');
            //     redirect('garment/orders');
            // }

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
