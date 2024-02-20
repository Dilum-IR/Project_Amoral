<?php

class OrderMaterial{

    use Model;

    protected $table = 'order_material';

    protected $allowedCloumns = [
        'order_id',
        'material_id',
        'sleeve_id',
        'ptype_id',
        'unit_price',
        'xs',
        'small',
        'medium',
        'large',
        'xl',
        'xxl'
    ];

    public function updateOrderMaterial($ids, $data)
    {
        $keys = array_keys($data);
        $quary = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . ", ";
        }

        $quary = rtrim($quary, ", ");

        $whereClause = " WHERE ";
        foreach ($ids as $key => $id) {
            $whereClause .= $key . " = :" . $key . " AND ";
            $data[$key] = $id;
        }

        $whereClause = rtrim($whereClause, " AND ");

        $quary .= $whereClause;

        // run the query stage
        $this->quary($quary, $data);

        return false;
    }
}