<?php
    /*
    Contains database configuration
    User : "root"
    password : ""
    */

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'login');

    // Attempting to establish connection with the database
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Checking the connection
    if(!$conn){
        die("Connection failed to be established : ".sql_connect_error());
    }

?>