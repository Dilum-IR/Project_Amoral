<?php


class GarmentReport
{
	use Model;

	protected $table = 'report';

	protected $allowedCloumns = [
        'garment_id',
		'title',
		'description',
		'report_date',
	];
}

