<?php

$string = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
// $con = new PDO($string, DBUSER, DBPASS);

$con = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

show($con);
