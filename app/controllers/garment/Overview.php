<?php

class Overview extends Controller
{
    public function index()
    {

        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($username != 'User' && $_SESSION['USER']->emp_status == "garment") {


            $info = $this->getInfo();
            $data['recent_orders'] = $this->get_order_data();
            $overview = $this->overview($data['recent_orders']);

            $data['info'] = $info;
            $data['overview'] = $overview;

            $data['chart_analysis_data'] = $this->chart_analysis_data($data['recent_orders']);
            // show($data);

            $this->view('garment/overview', $data);
        } else {
            redirect('home');
        }
    }

    private function getInfo()
    {

        $garment = new Garment();

        $id['garment_id'] = $_SESSION['USER']->emp_id;
        return $garment->first($id);
    }

    public function updateInfo()
    {

        $garment = new Garment();

        $data = $this->getInfo();

        if ($data->no_workers == $_POST['no_workers'] && $data->day_capacity == $_POST['day_capacity']) {
            echo json_encode(['u' => "no"]);
            return;
        }

        $garment->update($_SESSION['USER']->emp_id, $_POST, 'garment_id');

        echo json_encode(['u' => "yes"]);
    }
    private function overview($orders)
    {

        // show($data);
        $garment = new GarmentOrder;

        //find not compleated orders where login garments
        // not compleated mean that orders are given but processing that is relevent garments
        $data['status1'] = "completed";
        $data['status2'] = "canceled";

        $current = $garment->whereAndOR(['garment_id' => $_SESSION['USER']->emp_id], $data);

        if ($current != false)

            $overview['current'] = $current[0]->current_orders;
        else
            $overview['current'] = 0;

        // find the count of the cancel orders
        $arr['garment_id'] =  $_SESSION['USER']->emp_id;
        $arr['status'] =  "canceled";

        $cancel_orders = $garment->where($arr);

        if ($cancel_orders != false)

            $overview['cancel_orders'] = count($cancel_orders);
        else
            $overview['cancel_orders'] = 0;

        $overview['sales']  = $this->calculateSales($orders);

        return $overview;
    }



    private function calculateSales($orders)
    {
        date_default_timezone_set('UTC');

        // today date
        $currentMonthDate_2 = date('Y-m-d');
        // current month last-(one month ago) date
        $currentMonthDate_1 = date('Y-m-d', strtotime('-1 month'));

        // Convert dates to timestamp for current month
        $currentMonthDateTS_1 = strtotime($currentMonthDate_1);
        $currentMonthDateTS_2 = strtotime($currentMonthDate_2);


        // last month first date
        $lastMonthDate_1 = date('Y-m-d', strtotime('-2 month'));
        // last month last date
        $lastMonthDate_2 = date('Y-m-d', strtotime('-1 month'));

        // Convert dates to timestamp for current month
        $lastMonthDateTS_1 = strtotime($lastMonthDate_1);
        $lastMonthDateTS_2 = strtotime($lastMonthDate_2);

        $currentMonthTotalSales = 0;
        $pastMonthTotalSales = 0;

        //total each sewed and cutting sales from orders
        $total_sewed  = 0;
        $total_cutting  = 0;

        //no. of orders
        $compleated_orders = 0;
        $current_sewed  = 0;
        $current_cutting  = 0;
        $current_pending  = 0;

        $currentMonthCompleatedOrders = 0;
        $lastMonthCompleatedOrders = 0;

        // echo  $lastMonthDateTS_1 . "</br>";

        foreach ($orders as $item) {

            // get each orders garment for place date timestamp value
            // check that date is available in that current date and last date between
            $checkDateTS = strtotime(date("Y-m-d", strtotime($item->placed_date)));


            $cutPrice = $item->cut_price;
            $sewedPrice = $item->sewed_price;
            $totalQty = $item->total_qty;

            if ($item->status == 'completed') {

                $compleated_orders += 1;

                // all compleated orders sewed and cuting sales get
                $total_cutting += $cutPrice * $totalQty;
                $total_sewed += $sewedPrice * $totalQty;

                // get current month orders total sales
                if ($checkDateTS > $currentMonthDateTS_1 && $checkDateTS <= $currentMonthDateTS_2) {
                    $currentMonthTotalSales += ($totalQty * $cutPrice) + ($totalQty * $sewedPrice);
                    $currentMonthCompleatedOrders += 1;
                }
                // get last month orders total sales
                elseif ($checkDateTS > $lastMonthDateTS_1 && $checkDateTS <= $lastMonthDateTS_2) {
                    $pastMonthTotalSales += ($totalQty * $cutPrice) + ($totalQty * $sewedPrice);
                    $lastMonthCompleatedOrders += 1;
                    // echo  $item->order_id . "</br>";
                }
                // echo  $checkDateTS . "</br>";
            }
            // no. of current sawed and cutting orders
            else if ($item->status == 'cutting') {
                $current_cutting += 1;
            } else if ($item->status == 'sewing') {
                $current_sewed += 1;
            } elseif ($item->status == 'pending') {
                $current_pending += 1;
            }
        }

        // echo  $lastMonthDateTS_2 . "</br>";

        //total sales orders precentage
        $current_last_Month_total_Sales = $currentMonthTotalSales + $pastMonthTotalSales;
        $SalesPercentage = 0;

        if ($current_last_Month_total_Sales != 0) {
            $SalesPercentage = ($currentMonthTotalSales / $current_last_Month_total_Sales) * 100;
        }

        // total compleated orders precentage
        $totalCompletedOrders = $lastMonthCompleatedOrders + $currentMonthCompleatedOrders;
        $completedOrdersPercentage = 0;

        if ($totalCompletedOrders != 0) {
            $completedOrdersPercentage = ($currentMonthCompleatedOrders / $totalCompletedOrders) * 100;
        }


        $total_sales =  $total_sewed + $total_cutting;
        return [
            'compleated_orders' => $compleated_orders,
            'current_sewed' => $current_sewed,
            'current_cutting' => $current_cutting,
            'current_pending' => $current_pending,

            'total_sales' =>  $total_sales,
            'total_sewed' =>  $total_sewed,
            'total_cutting' =>  $total_cutting,

            // 'current_month_sales' => $currentMonthTotalSales,
            // 'past_month_sales' => $pastMonthTotalSales,
            'sales_percentage' => $SalesPercentage,
            'completed_percentage' => $completedOrdersPercentage,
        ];
    }


    private function get_order_data()
    {
        try {

            $garment_order = new GarmentOrder;

            $data['garment_id'] = $_SESSION['USER']->emp_id;

            $result = $garment_order->getGarmentOrderData($data);
            $i = 0;

            foreach ($result as $item) {

                // removed canceled orders
                if ($item->status == 'canceled') {
                    unset($result[$i]);
                } else {

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
                }

                $i++;
            }

            // show($result);

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
                }
            }

            $new_result = [];
            $id_array = [];

            foreach ($result as $item) {

                if (!in_array($item->order_id, $id_array)) {

                    array_push($id_array, $item->order_id);
                    array_push($new_result, $item);
                }
            }

            // show($id_array);

            $material_array = [];
            // create a new array for toal qty and meterial type array
            foreach ($new_result as $item) {
                $total_qty = 0;

                foreach ($item->mult_order as $value) {

                    if (!in_array($value['material_type'], $material_array)) {
                        array_push($material_array, $value['material_type']);
                    }
                    $total_qty += $value['qty'];
                }

                $item->total_qty = $total_qty;
                $item->material_array = $material_array;
            }


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
                unset($new_result[$i]->emp_id);
                unset($new_result[$i]->mult_order);
            }

            // show($new_result);

            // Extract the first 10 elements
            $first_10_elements = array_slice($new_result, 0, 10);

            return $first_10_elements;
        } catch (\Throwable $th) {
            redirect('404');
        }
    }
    private function chart_analysis_data($orders)
    {
        $sales_with_days = [];
        $cut_sales_with_days = [];
        $sewed_sales_with_days = [];

        $monthly_revenue = [];
        $monthly_qty = [];

        foreach ($orders as $key => $item) {

            if ($item->status == 'completed') {

                $dateTS = date("Y-m-d", strtotime($item->placed_date));

                // each dates for total revenue and sales and cutting revenue
                if (empty($sales_with_days[$dateTS]))
                    $sales_with_days[$dateTS] = $item->total_qty * ($item->cut_price + $item->sewed_price);

                else
                    $sales_with_days[$dateTS] += $item->total_qty * ($item->cut_price + $item->sewed_price);

                if (empty($cut_sales_with_days[$dateTS]))
                    $cut_sales_with_days[$dateTS] = $item->total_qty * $item->cut_price;

                else
                    $cut_sales_with_days[$dateTS] += $item->total_qty * $item->cut_price;

                if (empty($sewed_sales_with_days[$dateTS]))
                    $sewed_sales_with_days[$dateTS] = $item->total_qty * $item->sewed_price;

                else
                    $sewed_sales_with_days[$dateTS] += $item->total_qty * $item->sewed_price;


                // caalculated monthly revenue and completed order quantity
                $placed_month = date('Y-m', strtotime($item->placed_date));

                if (!isset($monthly_revenue[$placed_month])) {
                    $monthly_revenue[$placed_month] = 0;
                }
                if (!isset($monthly_qty[$placed_month])) {
                    $monthly_qty[$placed_month] = 0;
                }

                $monthly_revenue[$placed_month] += ($item->cut_price + $item->sewed_price) * $item->total_qty;
                $monthly_qty[$placed_month] +=  $item->total_qty;
            }
        }

        // show($monthly_qty);

        return [
            "total_sales" => $sales_with_days,
            "cut_sales" => $cut_sales_with_days,
            "sewed_sales" => $sewed_sales_with_days,
            "monthly_revenue" => $monthly_revenue,
            "monthly_qty" => $monthly_qty,
        ];
    }


    // genarate report function call from js 
    public function genarate_report()
    {

        try {

            $arr = [];
            if (!isset($_POST['garment_id']) || $_SESSION['USER']->emp_status != "garment" || $_SESSION['USER']->emp_id != $_POST['garment_id']) {
                $arr['user'] = false;

                echo json_encode($arr);
                exit;
            }

            // $garment_order = new GarmentOrder;

            // $data['garment_id'] = $_SESSION['USER']->emp_id;

            // $result = $garment_order->getGarmentOrderData($data);

            $fromDate = $_POST['from_date'];
            $toDate = $_POST['to_date'];

            $fromDateTS = strtotime($fromDate);
            $toDateTS = strtotime($toDate);

            $result = $this->get_order_data();

            // $value1TS = date("Y-m-d", strtotime($result[0]->placed_date));
            // $valueTS1 = strtotime($value1TS);

            $newresult = [];
            foreach ($result as $key => $value) {
                // nedd to change with compleated date
                $valueTS = date("Y-m-d", strtotime($value->placed_date));
                $valueTSnew = strtotime($valueTS);

                // get the each garment orders only then validate with compleated and date duration
                if ($value->status == "completed" && ($fromDateTS <= $valueTSnew) && ($toDateTS >= $valueTSnew)) {
                    array_push($newresult, $value);
                }
            }
            echo json_encode($newresult);
        } catch (\Throwable $th) {
            $arr['user'] = false;

            echo json_encode($arr);
            exit;
        }
    }
}
