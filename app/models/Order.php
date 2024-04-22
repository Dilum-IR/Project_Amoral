<?php


class Order
{
	use Model;


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

    function findLast(){
        $quary = "SELECT * FROM $this->table
        ORDER BY order_id DESC
        LIMIT 1;";
        return $this->quary($quary);
    }

    function getFullData($data=[]){
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

    function getUserData(){
        $quary = "SELECT $this->table.*, users.*
        FROM $this->table
        INNER JOIN users
        ON users.id = $this->table.user_id;";
        return $this->quary($quary);
    }

}

