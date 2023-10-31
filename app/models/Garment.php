<?php


class Garment
{
	use Model;

	protected $table = 'garment';

	protected $allowedCloumns = [
		'name',
		'email',
		'password',
        'location',
	];
}

