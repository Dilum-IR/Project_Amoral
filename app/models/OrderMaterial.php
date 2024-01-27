<?php

class OrderMaterial{

    use Model;

    protected $table = 'order_material';

    protected $allowedCloumns = [
        'order_id',
        'material_id',
        'xs',
        'small',
        'medium',
        'large',
        'xl',
        '2xl'
    ];
}