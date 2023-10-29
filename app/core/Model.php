<?php

require_once 'Database.php';

trait Model
{

    use Database;

    protected $limit        = 10;
    protected $offset       = 0;
    protected $order_type   = 'DESC';
    protected $order_column = 'id';
    public $errors          = [];

    public function findAll()
    {

        $quary = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;
        // run the quary stage
        return $this->quary($quary);
    }

    public function first($data, $data_not = [])
    {

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $quary = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " && ";
        }
        foreach ($keys_not as $key) {
            $quary .= $key . " != :" . $key . " && ";
        }

        $quary = trim($quary, " && ");
        $quary .= " limit $this->limit offset $this->offset";

        // echo $quary;

        $data = array_merge($data, $data_not);
        // run the quary stage
        $result = $this->quary($quary, $data);
        if ($result) {

            return $result[0];
        }
        return false;
    }

    // find already registerd users
    public function findUser($data)
    {

        unset($data['fullname']);
        unset($data['password']);

        $key = 'email';

        // $keys_not = array_keys($data_not);
        $quary = "SELECT * FROM $this->table WHERE $key = :$key 
        limit $this->limit offset $this->offset";

        // echo $quary;

        $data = array_merge($data);
        // run the quary stage  

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $result = $this->quary($quary, $data);
        if ($result) {

            return $result[0];
        }
        return false;
    }

    public function insert($data)
    {
        $keys = array_keys($data);
        $quary = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ") ";

        // echo $quary;

        // run the quary stage
        $this->quary($quary, $data);
        return false;
    }

    public function update($id, $data, $id_column = 'id')
    {
        $keys = array_keys($data);
        $quary = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . ", ";
        }

        $quary = trim($quary, " , ");
        $quary .= " WHERE $id_column = :$id_column ";

        $data[$id_column] = $id;

        // echo $quary;

        // run the quary stage
        $this->quary($quary, $data);

        return false;
    }
    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $quary = "DELETE FROM $this->table WHERE $id_column = :$id_column ";

        // echo $quary;

        // run the quary stage
        $this->quary($quary, $data);

        return false;
    }


    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $quary = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " && ";
        }
        foreach ($keys_not as $key) {
            $quary .= $key . " != :" . $key . " && ";
        }

        $quary = trim($quary, " && ");
        $quary .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;

        $data = array_merge($data, $data_not);
        // run the quary stage
        return $this->quary($quary, $data);
    }
}
