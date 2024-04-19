<?php

require_once 'Database.php';

trait Model
{

    use Database;

    protected $limit = 100;
    protected $offset = 0;
    protected $order_type = 'ASC';
    protected $order_column = 'id';
    public $errors = [];

    public function findAll($order_column = 'id')
    {

        $quary = "SELECT * FROM $this->table ORDER BY $order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;
        // run the quary stage
        return $this->quary($quary);
    }
    public function findAll_selectedColumn($order_column = 'id', $allowedCloumns = ["*"])
    {
        $quary = "SELECT ";

        foreach ($allowedCloumns as $key) {
            $quary .= $key . ",";
        }
        $quary = trim($quary, ",");

        $quary .= " FROM $this->table WHERE is_active = 1 ORDER BY $order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;
        // return;  
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
        //    $quary .= " ORDER BY $order_column $orderType limit $this->limit offset $this->offset";

        // echo $quary;

        $data = array_merge($data, $data_not);
        // run the quary stage
        $result = $this->quary($quary, $data);
        if ($result) {

            return $result[0];
        }
        return false;
    }
    public function first_selectedColumn($data, $allowedCloumns, $data_not = [])
    {

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $quary = "SELECT ";

        foreach ($allowedCloumns as $key) {
            $quary .= $key . ",";
        }
        $quary = trim($quary, ",");

        $quary .= " FROM $this->table WHERE ";

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

    public function insertAllowed($data, $columns = [])
    {
        // If $columns is empty, use all keys from $data
        if (empty($columns)) {
            $columns = array_keys($data);
        }

        // Filter $data to only include keys present in $columns
        $data = array_intersect_key($data, array_flip($columns));

        // If $data is empty after filtering, return false
        if (empty($data)) {
            return false;
        }

        $keys = array_keys($data);
        $quary = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ") ";

        // echo $quary;

        // Run the quary
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
        // $quary .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;

        $data = array_merge($data, $data_not);
        // run the quary stage
        return $this->quary($quary, $data);
    }
    public function whereOR($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $quary = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " OR ";
        }
        foreach ($keys_not as $key) {
            $quary .= $key . " != :" . $key . " OR ";
        }

        $quary = trim($quary, " OR ");
        // $quary .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;

        $data = array_merge($data, $data_not);
        // run the quary stage
        return $this->quary($quary, $data);
    }

    public function findAll_withInner($reference_table, $refe_column1 = 'id', $refe_column2 = 'id')
    {

        $quary = "SELECT * FROM $this->table JOIN $reference_table 
                            ON $this->table.$refe_column1 = $reference_table.$refe_column2
                            ORDER BY $refe_column1 $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;
        // run the quary stage
        return $this->quary($quary);
    }

    // FIND DATA USING INNER JOIN
    public function find_withInner($data, $reference_table, $refe_column1 = 'id', $refe_column2 = 'id', $allow_columns = ["*"])
    {
        $keys = array_keys($data);

        $quary = "SELECT ";

        $l = "";
        foreach ($allow_columns as $allow_column) {
            $l .= $allow_column . " , ";
        }
        $l = trim($l, " , ");

        $quary .= $l;

        $quary .= " FROM $this->table JOIN $reference_table 
                            ON $this->table.$refe_column1 = $reference_table.$refe_column2
                            WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " AND ";
        }

        $quary = trim($quary, " AND ");

        $quary .= " ORDER BY $this->table.$refe_column1 $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;

        // run the quary stage
        return $this->quary($quary, $data);
    }


    // FIND DATA USING LEFT OUTER JOIN
    public function find_withLOJ($data, $reference_table, $refe_column1 = 'id', $refe_column2 = 'id')
    {
        $keys = array_keys($data);

        $quary = "SELECT * FROM $this->table LEFT OUTER JOIN $reference_table 
                            ON $this->table.$refe_column1 = $reference_table.$refe_column2
                            WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " AND ";
        }
        $quary = trim($quary, " AND ");

        $quary .= " ORDER BY $refe_column1 $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;
        // run the quary stage
        return $this->quary($quary, $data);
    }

    // FIND DATA USING RIGHT OUTER JOIN
    public function find_withROJ($data, $reference_table, $refe_column1 = 'id', $refe_column2 = 'id')
    {
        $keys = array_keys($data);

        $quary = "SELECT * FROM $this->table LEFT OUTER JOIN $reference_table 
                            ON $this->table.$refe_column1 = $reference_table.$refe_column2
                            WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " AND ";
        }
        $quary = trim($quary, " AND ");

        $quary .= " ORDER BY $refe_column1 $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;
        // run the quary stage

        return $this->quary($quary, $data);
    }

    //function to access a value of another table by foreign key
    public function get($table, $id_column = 'id')
    {
        $quary = "SELECT $this->table.*, $table.* FROM $this->table INNER JOIN $table ON $this->table.$id_column = $table.$id_column";
        // echo $quary;
        return $this->quary($quary);
    }

    public function findAllActive($order_column = 'id')
    {

        $quary = "SELECT * FROM $this->table WHERE is_active = 1  ORDER BY $order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;
        // run the quary stage
        return $this->quary($quary);
    }

    public function find_ActivewithInner($data, $reference_table, $refe_column1 = 'id', $refe_column2 = 'id', $allow_columns = ["*"])
    {
        $keys = array_keys($data);

        $quary = "SELECT ";

        $l = "";
        foreach ($allow_columns as $allow_column) {
            $l .= $allow_column . " , ";
        }
        $l = trim($l, " , ");

        $quary .= $l;

        $quary .= " FROM $this->table  JOIN $reference_table 
                        ON $this->table.$refe_column1 = $reference_table.$refe_column2
                        AND  $this->table.is_active = 1
                        WHERE ";

        foreach ($keys as $key) {
            $quary .= $key . " = :" . $key . " AND ";
        }

        // Add condition for is_active column
        // $quary .= "$reference_table.is_active = 1 AND ";

        $quary = trim($quary, " AND ");

        $quary .= " ORDER BY $this->table.$refe_column1 $this->order_type LIMIT $this->limit OFFSET $this->offset";

        // echo $quary;

        // run the query stage
        return $this->quary($quary, $data);
    }
}
