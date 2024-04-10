<?php

class DesignCollection 
{
    use Model;

    protected $table = 'collection';

    protected $allowedcolumns = [
        'id',
        'image_name',
        'price',
        'material_type',
    ];


}