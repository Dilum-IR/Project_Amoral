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

}

