<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $getName = $name;
    echo $getName;
} else {
    echo "Invalid request";
}

// print_r($_POST);

// echo $name;
