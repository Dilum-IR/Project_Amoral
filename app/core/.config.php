<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {

    // database configaration 

    // define('DBHOST', 'localhost');
    define('DBHOST', 'localhost');
    define('DBNAME', 'amoral_db');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'http://localhost/project_Amoral/public');
} else {

    // database configaration
    define('DBNAME', 'amoral_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'https://www.websitename.com');
}

// https://code.tutsplus.com/pdo-vs-mysqli-which-should-you-use--net-24059t

// https://www.javatpoint.com/form-validation-in-php