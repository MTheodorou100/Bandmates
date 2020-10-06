<?php
   include("config.php");
   session_start();

      $sql = "SELECT * FROM Admins";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
  
      
  if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['submit']!=null) {
      $myusername = mysqli_real_escape_string($db,$_POST['user_name']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
       
      $sql = "INSERT INTO Admins (aUsername, aPass) VALUES ('$myusername', '$mypassword');";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
         header("location: adminaccounts.php");
  }

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['delete']!=null) {
      $sql = "DELETE FROM Admins WHERE idAdmins='$_POST[delid]';";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
         header("location: adminaccounts.php");
  }
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['update']!=null) {
        $myusername = mysqli_real_escape_string($db,$_POST['uuser_name']);
      $mypassword = mysqli_real_escape_string($db,$_POST['upassword']); 
      $sql = "UPDATE Admins SET aUsername = '$myusername', aPass = '$mypassword' WHERE idAdmins='$_POST[upid]'; ";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
       header("location: adminaccounts.php");
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
        
        <h2>Add an Account:</h2>
         <form action="" method="POST">
        Username: <input type=text name=user_name id="user_name" required>
        <br/><br/>
        Password: <input type=password name=password id="password" minlength=6 required>
        <br><br/>
        <input type="submit" value="register" name="submit" id="registerButton"/>
    </form>
        
        <h2>Update an Account:</h2>
        <p>Enter an Admin ID you would like to update/make changes to:</p>
         <form action="" method="POST">
        Admin ID: <input type=text name=upid id="upid" required>
        <br/><br/>
        Username: <input type=text name=uuser_name id="uuser_name" required>
        <br/><br/>
        Password: <input type=password name=upassword id="upassword" minlength=6 required>
        <br><br/>
             
        <input type="submit" value="update" name="update" id="updateButton"/>
    </form>
        
                <h2>Delete an Account:</h2>
        <p>Enter the Admin ID you would like to remove:</p>
         <form action="" method="POST">
        Admin ID: <input type=text name=delid id="delid" required>
        <br/><br/>
        <input type="submit" value="delete" name="delete" id="delButton"/>
    </form>
    </body>
</html>