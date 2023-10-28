<?php

class Order{

    use Model;

    protected $table = 'orders';

    protected $allowedCloumns = [
        'id',
        'price',
        'quantity',
        'date'
    ];


}

?>