<?php


class Order
{
    use Model;


    // don't change
    protected $table = 'orders';

    public $order_id = 'order_id';

    protected $allowedColumns = [

        'order_id',
        'user_id',
        'discount',
        'total_price',
        'dispatch_date',
        'remaining_payment',
        'order_placed_on',
        'order_status',
        'city',
        'pdf',
        'image1',
        'image2',
        'is_delivery',
        'latitude',
        'longitude',
        'deliver_id'
    ];

    function findLast()
    {
        $quary = "SELECT * FROM $this->table
        ORDER BY order_id DESC
        LIMIT 1;";
        return $this->quary($quary);
    }

    function getFullData($data = [])
    {
        $keys = array_keys($data);
        $quary = "SELECT $this->table.user_id, order_material.*, material_stock.material_type, sleeves.type, printing_type.printing_type
        FROM order_material 
        INNER JOIN $this->table 
        ON $this->table.order_id = order_material.order_id 
        INNER JOIN material_stock
        ON material_stock.stock_id = order_material.material_id
        INNER JOIN sleeves
        ON sleeves.sleeve_id = order_material.sleeve_id
        INNER JOIN printing_type
        ON printing_type.ptype_id = order_material.ptype_id ";

        if (!empty($keys)) {
            $quary .= " WHERE ";

            foreach ($keys as $key) {
                $quary .= $key . " = :" . $key . " && ";
            }

            $quary = trim($quary, " && ");
        }

        return $this->quary($quary, $data);
    }

    function getUserData()
    {
        $quary = "SELECT $this->table.*, users.*
        FROM $this->table
        INNER JOIN users
        ON users.id = $this->table.user_id;";
        return $this->quary($quary);
    }



    function getAllOrderData($data)
    {
        $quary = "SELECT $this->table.user_id, $this->table.total_price, $this->table.remaining_payment,
        $this->table.discount, $this->table.order_status , $this->table.delivered_date, $this->table.order_placed_on,
        order_material.*, material_stock.*, sleeves.price AS sleeves_price, printing_type.price AS print_price, 
        garment_order.cut_price, garment_order.sewed_price
        FROM order_material
        INNER JOIN $this->table 
        ON $this->table.order_id = order_material.order_id 
        INNER JOIN material_stock
        ON material_stock.stock_id = order_material.material_id
        INNER JOIN sleeves
        ON sleeves.sleeve_id = order_material.sleeve_id
        INNER JOIN printing_type
        ON printing_type.ptype_id = order_material.ptype_id
        INNER JOIN garment_order
        ON garment_order.order_id = order_material.order_id
        WHERE order_status = :order_status";

        // if need to validate that order is canceled or not

        $data = array_merge($data);

        // echo $quary;
        // die;

        return $this->quary(
            $quary,
            $data
        );
    }

    public function get_order_data($Alldata)
    {
        try {

            // show($Alldata);

            $i = 0;

            foreach ($Alldata as $item) {

                $qty = 0;
                $qty += $item->xs + $item->small + $item->medium + $item->large + $item->xl + $item->xxl;
                $item->qty = $qty;
                $item->id = $i;
                // initially included data pass to the array
                $item->mult_order = [
                    [
                        "material_type" => $item->material_type,
                        // "type" => $item->type,
                        // "printing_type" => $item->printing_type,
                        "unit_price" => $item->unit_price,
                        "ppm" => $item->ppm,
                        "sleeves_price" => $item->sleeves_price,
                        "print_price" => $item->print_price,
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

            // show($result);

            // find the same order id orders and merge that orders 
            // include : material ,sizes with more data
            foreach ($Alldata as $item) {

                foreach ($Alldata as $key => $value) {

                    if ($item->id != $value->id && $item->order_id == $value->order_id) {

                        $new_mult = [
                            "material_type" => $value->material_type,
                            // "type" => $value->type,
                            // "printing_type" => $value->printing_type,
                            "unit_price" => $item->unit_price,
                            "ppm" => $value->ppm,
                            "sleeves_price" => $item->sleeves_price,
                            "print_price" => $item->print_price,
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

            foreach ($Alldata as $item) {

                if (!in_array($item->order_id, $id_array)) {

                    array_push($id_array, $item->order_id);
                    array_push($new_result, $item);
                }
            }

            // show($id_array);

            // create a new array for toal qty and meterial type array
            foreach ($new_result as $item) {

                $material_array = [];
                $total_qty = 0;
                $cal_cost = 0;
                $sleeves_cost = 0;
                $material_cost = 0;
                $print_cost = 0;
                $workers_cost = 0;
                $delivery_cost = 0;

                foreach ($item->mult_order as $value) {

                    if (!in_array($value['material_type'], $material_array)) {
                        array_push($material_array, $value['material_type']);
                    }
                    $sleeves_cost = $value['qty'] * $value['sleeves_price'];
                    $material_cost = ($value['qty'] / $value['ppm'])  * $value['unit_price'];

                    // database include print prices directly used
                    $print_cost = $value['qty'] * $value['print_price'];

                    $total_qty += $value['qty'];
                    $cal_cost += $sleeves_cost + $material_cost + $print_cost;
                }

                $item->material_array = $material_array;
                $item->total_qty = $total_qty;
                $item->total_cost =  $delivery_cost + $workers_cost + $cal_cost +
                    $item->total_qty * ($item->cut_price + $item->sewed_price);
            }


            // remove order elements
            for ($i = 0; $i < count($Alldata); $i++) {

                unset($new_result[$i]->material_type);
                // unset($new_result[$i]->printing_type);
                // unset($new_result[$i]->type);

                unset($new_result[$i]->id);

                unset($new_result[$i]->xs);
                unset($new_result[$i]->small);
                unset($new_result[$i]->medium);
                unset($new_result[$i]->large);
                unset($new_result[$i]->xl);
                unset($new_result[$i]->xxl);
                unset($new_result[$i]->qty);

                unset($new_result[$i]->unit_price);
                unset($new_result[$i]->print_price);
                unset($new_result[$i]->sleeves_price);
                unset($new_result[$i]->ppm);
                unset($new_result[$i]->quantity);
                unset($new_result[$i]->stock_id);

                unset($new_result[$i]->material_id);
                unset($new_result[$i]->ptype_id);
                unset($new_result[$i]->sleeve_id);

                unset($new_result[$i]->mult_order);
                unset($new_result[$i]->cut_price);
                unset($new_result[$i]->sewed_price);
            }

            // show($new_result);

            return $new_result;
        } catch (\Throwable $th) {
            // redirect('404');
        }
    }


    // this method using find to the current orders in the orders table.
    public function whereAndOR($data, $data_not = [])
    {
        $keys = array_keys($data);

        $quary = "SELECT COUNT(*) AS current_orders FROM $this->table WHERE ";

        $quary .= " order_status NOT IN (";

        foreach ($data_not as $value) {
            $quary .= "'" . $value . "'" . " ,";
        }

        $quary = trim($quary, ",");
        $quary .= " ) AND ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " AND";
        }

        $quary = trim($quary, " AND");
        
        $data = array_merge($data);
        
        return $this->quary($quary, $data);
    }
    
}
