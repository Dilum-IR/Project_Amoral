<?php


class Order
{
	use Model;


    protected $table = 'orders';
    
    public $order_id = 'order_id';

    protected $allowedColumns = [

		'order_id',
		'user_id',
		'material',
        'unit_price',
        'total_price',
        'dispatch_date',
        'remaining_payment',
        'order_placed_on',
        'order_status',
        'small',
        'medium',
        'large',
        'district',
        'image',
        'is_quotation',
        'latitude',
        'longitude'
    ];

    function findLast(){
        $quary = "SELECT * FROM $this->table
        ORDER BY order_id DESC
        LIMIT 1;";
        return $this->quary($quary);
    }

    function getFullData($data){
        $keys = array_keys($data);
        $quary = "SELECT $this->table.user_id, order_material.* 
        FROM order_material 
        INNER JOIN $this->table 
        ON $this->table.order_id = order_material.order_id 
        WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " && ";
        }

        $quary = trim($quary, " && ");

        return $this->quary($quary, $data);
    }

}

