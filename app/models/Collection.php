<?php

Class Collection{
    use Model;

    protected $table = 'collection';

    public $allowedCloumns = [
        'image_name',
        'price',
        'material',
    ];

    function findLast(){
        $quary = "SELECT * FROM $this->table
        ORDER BY order_id DESC
        LIMIT 1;";
        return $this->quary($quary);
    }
}