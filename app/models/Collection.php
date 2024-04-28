<?php

Class Collection{
    use Model;

    protected $table = 'collection';

    public $allowedCloumns = [
        'image_id',
        'image_name',
        'price',
        'material',
    ];

    function findLast(){
        $quary = "SELECT * FROM $this->table
        ORDER BY image_id DESC
        LIMIT 1;";
        return $this->quary($quary);
    }
}