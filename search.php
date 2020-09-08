<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php


$q = intval($_GET['q']);

define('DB_SERVER', '35.197.167.52');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'mypassword');
   define('DB_DATABASE', 'bandmates');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

mysqli_select_db($db,"ajax_demo");
$sql="SELECT * FROM Person WHERE instrument = '".$q."'";
$result = mysqli_query($db,$sql);

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>instrument</th>
<th>Genre</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['firstName'] . "</td>";
  echo "<td>" . $row['surName'] . "</td>";
  echo "<td>" . $row['instrument'] . "</td>";
  echo "<td>" . $row['genre'] . "</td>";
  echo "</tr>";
}
echo "</table>";
#mysqli_close($db);
?>
</body>
</html>