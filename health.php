<?php
include_once('db/conn.php');

if ($conn) {
    echo "Database connection successful!";
    echo "\nHost: " . $servername;
    echo "\nDatabase: " . $dbname;
    echo "\nPort: " . $port;
} else {
    http_response_code(500);
    echo "Database connection failed!";
} 
