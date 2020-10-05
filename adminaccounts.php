<?php
   include("config.php");
   session_start();

      $sql = "SELECT * FROM Admins";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
  
      


?>
<!DOCTYPE html> 
<html>
    <head> 
    <title>Bandmates | Admin</title>
  </head>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

}
</style>
    <body>
        <h1>Administrator Accounts Available:</h1>
        <a href='admindash.php'>Go Back</a>
        <table>
        <tr>
            <th>Admin ID</th>
            <th>Admin Username</th>
            <th>Admin Password</th>
        </tr>
            <?php while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
           echo "<tr>";
            echo "<th>".$row['idAdmins']."</th>";
            echo "<th>".$row['aUsername']."</th>";
            echo "<th>".$row['aPass']."</th>";
        echo "</tr>";
}?>
        
            
            
            </table>
    </body>
</html>