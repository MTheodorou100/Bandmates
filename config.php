<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'progdatabase-1.ctxbjl62xf2l.us-east-2.rds.amazonaws.com ');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'mypassword');
define('DB_NAME', 'programmingdb');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>