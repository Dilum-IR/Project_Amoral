<?php

class GuestGarment
{
    use Model;

    protected $table ='guest_garment';

    protected $allowedColumns = [
        'name',
        'email',
        'address',
        'city',
        'manager_name',
        'manager_email',
        'manager_contact',
    ];
}