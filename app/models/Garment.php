<?php


class Garment
{
	use Model;

	protected $table = 'garment';

	protected $allowedCloumns = [
		'garment_id',
        'location',
		'day_capacity',
		'no_workers',
		'cut_price',
		'sewed_price'

	];
}

