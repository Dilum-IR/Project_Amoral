<?php

class MaterialStock{

    use Model;

    protected $table = 'material_stock';

    protected $allowedCloumns = [
        'stock_id',
        'material_type',
        'quantity',
        'unit_price'
    ];
}