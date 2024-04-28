<?php

class Deliveryman{
    use Model;

    protected $table = 'deliveryman';

    public $allowedCloumns = [
        'emp_id',
        'vehicle_type',
        'max_capacity',
        'vehicle_number',
    ];
}