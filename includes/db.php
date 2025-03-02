<?php

function getConnection():mysqli
{
    $hostname = 'localhost';
    $dbName = 'projectweb';
    $username = 'projectweb';
    $password = '1234';
    $conn = new mysqli($hostname, $username, $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

require_once DATABASE_DIR . '/users.php';
require_once DATABASE_DIR . '/authen.php';
 require_once DATABASE_DIR . '/event.php';
 require_once DATABASE_DIR . '/registration.php';