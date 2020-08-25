<?php
session_start();
include("config.php");
if($db == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$item = ($_REQUEST['item']);    

$sql = "SELECT * FROM Person WHERE instrument LIKE '%".$item."%'";
$r_query = mysql_query($sql);

$row = mysql_fetch($r_query);
echo $row;
?>