<?php

function get_db_connection(): mysqli
{
    $servername = 'thewall-db';
    $username = 'thewall_user';
    $password = 'new_strong_password';
    $dbname = 'm6prog_thewall';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
