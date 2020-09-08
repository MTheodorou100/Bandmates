<?php
session_start();
include("config.php");
if($db == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$item = ($_REQUEST['item']);    

$sql = "SELECT * FROM Person WHERE instrument LIKE '%".$item."%'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo "Name: " . $row["firstName"]. " " . $row["surName"]. "<br>";
      return;

      header("Location: http://titan.csit.rmit.edu.au/~s3492611/prog1/index.php");

    }
  } else {
    echo "0 results";
  }
  


?>