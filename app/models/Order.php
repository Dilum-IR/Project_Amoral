<?php


class Order
{
	use Model;

	protected $table = 'order';

	protected $allowedCloumns = [
		'order_id',
		'user_id',
		'material',
        'quantity',
        'unit_price',
        'total_price',
        'dispatch_date',
        'remaining_payment',
        'order_placed_on',
        'order_status',
        'small',
        'large',
	];
}

