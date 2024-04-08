<?php

class PrintingType{

    use Model;  

    protected $table = 'printing_type';

    protected $allowedCloumns = [
        'ptype_id',
        'printing_type',
        'price'
    ];

}