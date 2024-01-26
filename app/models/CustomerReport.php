<?php

class CustomerReport{
    use Model;

    protected $table = 'report';

    protected $allowedcolumns = [
        'report_id',
        'user_id',
        'email',
        'title',
        'description',
        'report_date',
    ];
}