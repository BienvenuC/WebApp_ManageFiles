
<?php

//Set connexion data
    $servername = "localhost";
    $dbuser = 'root';
    $dbpassword = '';
    $dbname = 'files_db';
    $port = '3308'; //Default must be NULL to use default port
    //Establish connection
    $conn = new mysqli($servername, $dbuser, $dbpassword, $dbname, $port);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //$conn -> close();

?>
