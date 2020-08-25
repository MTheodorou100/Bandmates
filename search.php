<?php
$item = mysql_real_escape_string($_REQUEST['item']);    

$sql = "SELECT * FROM Person WHERE instrument LIKE '%".$item."%'";
$r_query = mysql_query($sql);

while ($row = mysql_fetch_array($r_query)){ 
echo 'Name: ' .$row['firstName']; 
echo '<br /> Surname: ' .$row['surName']; 
echo '<br /> Plays: '.$row['instrument']; 
echo '<br /> Category: '.$row['genre'];   
} 

?>