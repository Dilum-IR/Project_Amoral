<?php


class AllUsers
{
    use Model;

    protected $table = 'all_users';

    protected $allowedCloumns = [

        'id',
        'email',
    ];
}
