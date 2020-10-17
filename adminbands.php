<?php
   include("config.php");
   session_start();
   // Admin access to bands
      $sql = "SELECT * FROM Band";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
  
      
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['delete']!=null) {
      $sql = "DELETE FROM Band WHERE bandID='$_POST[delid]';";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
         header("location: adminbands.php");
  }


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
h1 {
  color: black;
  font-family: verdana;
}
h2 {
  color: black;
  font-family: verdana;
}
p {
  font-family: verdana;
}
          
input {
   font-family: verdana;    
}

form {
   font-family: verdana;   
}
}
</style>
    <body>
        <h1>Bands Available:</h1>
        <a href='admindash.php'>Go Back</a>
        <table>
        <tr>
            <th>Band ID</th>
            <th>Band Name</th>
            <th>Band Password</th>
        </tr>
            <?php while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
           echo "<tr>";
            echo "<th>".$row['bandID']."</th>";
            echo "<th>".$row['bandName']."</th>";
            echo "<th>".$row['bandPassword']."</th>";
        echo "</tr>";
}?>
        
            
            
            </table>
          
                <h2>Delete an Account:</h2>
        <p>Eneter the Band ID you would like to remove:</p>
         <form action="" method="POST">
        Band ID: <input type=text name=delid id="delid" required>
        <br/><br/>
        <input type="submit" value="delete" name="delete" id="delButton"/>
    </form>
    </body>
</html>
