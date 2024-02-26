<?php


class Garment
{
	use Model;

	protected $table = 'garment';

	protected $allowedCloumns = [
		'garment_id',
		'name',
		'email',
		'password',
        'location',
		'contact_number',
		'garment_image'
	];
}

