<?php

class QuotationReply{

    use Model;

    protected $table = 'quotation_reply';

    protected $allowedCloumns = [
        'requ_id',
        'order_id',
        'user_id',
        'emp_id',
        'replyed_date',
        'special_note'
    ];

    // i need employee name, user name and order details
    public function getReplyDetails($id)
    {
        $quary	= "SELECT * FROM $this->table
        LEFT JOIN orders
        ON $this->table.order_id = orders.order_id
        LEFT JOIN users
        ON $this->table.user_id = users.id
        LEFT JOIN employee
        ON $this->table.emp_id = employee.emp_id
        WHERE $this->table.user_id = :user_id";

        return $this->quary($quary, $id);
    }
}