<?php

class Sleeves{
    use Model;

    protected $table = 'sleeves';

    protected $allowedCloumns = [
        'sleeve_id',
        'type',
        'price'
    ];
}

?>