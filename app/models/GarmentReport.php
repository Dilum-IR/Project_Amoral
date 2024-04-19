<?php


class GarmentReport
{
	use Model;

	protected $table = 'report';

	protected $allowedCloumns = [
		'report_id',
        'garment_id',
        'title',
        'description',
        'report_date',
        'email',

	];
}

