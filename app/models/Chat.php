<?php


class Chat
{
    use Model;

    protected $table = 'chat';

    protected $allowedCloumns = [

        'chat_id',
        'from_id',
        'to_id',
    ];
}
