<?php


class Garment
{
	use Model;

	protected $table = 'garment';

	protected $allowedCloumns = [
	
		'garment_id',
		// 'name',
	
		// 'password',
        'location',
		// 'contact_number',
		// 'garment_image',
		'day_capacity',
		'no_workers',
		'cut_price',
		'sewed_price',
	];
}

