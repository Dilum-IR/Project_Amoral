<?php

trait Database
{
    private function connect()
    {

        $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        $con = new PDO($string, DBUSER, DBPASS);

        // $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        /* check connection */
        // show($con);
        return $con;
    }

    public function quary($quary, $data = [])
    {

        $con = $this->connect();
        $stm = $con->prepare($quary);

        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);

            if (is_array($result) && count($result)) {
                return $result;
            }
        }
        return false;
    }
    public function get_row($quary, $data = [])
    {

        $con = $this->connect();
        $stm = $con->prepare($quary);

        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);

            if (is_array($result) && count($result)) {
                return $result[0];
            }
        }


        return false;
    }
}
