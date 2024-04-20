<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {

    // database configaration 
    define('DBHOST', 'database-1.c7o6omamscmf.eu-north-1.rds.amazonaws.com');
    define('DBUSER', 'admin');
    define('DBPASS', 'Admin#1234');
    define('DBDRIVER', '');    
    define('DBNAME', 'amoral_db');

    define('ROOT', 'http://localhost/project_Amoral/public');
} else {

    // database configaration
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');    
    define('DBNAME', 'amoral_db');

    define('ROOT', 'https://www.websitename.com');
}

// https://code.tutsplus.com/pdo-vs-mysqli-which-should-you-use--net-24059t

// https://www.javatpoint.com/form-validation-in-php