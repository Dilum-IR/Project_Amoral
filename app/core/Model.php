<?php

require_once 'Database.php';

class Model {

    use Database;

    function test(){

        $quary = "SELECT * FROM users";
        $result = $this->quary($quary);
        show($result);
    }

}