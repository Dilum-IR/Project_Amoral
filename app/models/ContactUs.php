<?php


class ContactUs{

    use Model;

    protected $table = 'contact_us';

    public $allowedCloumns = [
        'email',
        'message',
    ];

}