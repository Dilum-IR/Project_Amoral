<?php

trait Database
{
    private function connect()
    {

        try {

            $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
            $con = new PDO($string, DBUSER, DBPASS);

            return $con;
        } catch (\Throwable $th) {
            // redirect('failure');
        }
    }

    public function quary($quary, $data = [])
    {

        try {
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
        } catch (\Throwable $th) {
            // redirect('failure');
        }
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
