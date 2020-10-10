<?php
   include("config.php");
   session_start();

      $sql = "SELECT * FROM Person";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
  
      
  if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['submit']!=null) {
      $myusername = mysqli_real_escape_string($db,$_POST['user_name']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      $myfname = mysqli_real_escape_string($db,$_POST['first_name']);
      $mylname = mysqli_real_escape_string($db,$_POST['last_name']);
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
       
      $sql = "INSERT INTO Person (firstName, surName, username, password, email) VALUES ('$myfname', '$mylname', '$myusername', '$mypassword', '$myemail');";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
         header("location: adminmembers.php");
  }

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['delete']!=null) {
      $sql = "DELETE FROM Person WHERE personID='$_POST[delid]';";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
         header("location: adminmembers.php");
  }
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['update']!=null) {
      $myusername = mysqli_real_escape_string($db,$_POST['uuser_name']);
      $mypassword = mysqli_real_escape_string($db,$_POST['upassword']);
      $myfname = mysqli_real_escape_string($db,$_POST['ufirst_name']);
      $mylname = mysqli_real_escape_string($db,$_POST['ulast_name']);
      $myemail = mysqli_real_escape_string($db,$_POST['uemail']);
      $sql = "UPDATE Person SET username = '$myusername', password = '$mypassword', firstName= '$myfname', surName='$mylname', email = '$myemail' WHERE personID='$_POST[upid]'; ";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
       header("location: adminmembers.php");
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
        <h1>Member Accounts Available:</h1>
        <a href='admindash.php'>Go Back</a>
        <table>
        <tr>
            <th>Person ID</th>
            <th>Firstname</th>
            <th>Surname</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
        </tr>
            <?php while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
           echo "<tr>";
            echo "<th>".$row['personID']."</th>";
            echo "<th>".$row['firstName']."</th>";
            echo "<th>".$row['surName']."</th>";
            echo "<th>".$row['username']."</th>";
            echo "<th>".$row['password']."</th>";
             echo "<th>".$row['email']."</th>";
        echo "</tr>";
}?>
        
            
            
            </table>
        
        <h2>Add an Account:</h2>
         <form action="" method="POST">
        Username: <input type=text name=user_name id="user_name" required>
        <br/><br/>
        Password: <input type=password name=password id="password" minlength=6 required>
        <br><br/>
        First Name: <input type=text name=first_name id="first_name" required>
        <br/><br/>
        Last Name: <input type=text name=last_name id="last_name" required>
        <br/><br/>
        Email: <input type=text name=email id="email" required>
        <br/><br/>
        <input type="submit" value="register" name="submit" id="registerButton"/>
    </form>
        
        <h2>Update an Account:</h2>
        <p>Enter an User ID you would like to update/make changes to:</p>
         <form action="" method="POST">
        User ID: <input type=text name=upid id="upid" required>
        <br/><br/>
        Username: <input type=text name=uuser_name id="uuser_name" required>
        <br/><br/>
        Password: <input type=password name=upassword id="upassword" minlength=6 required>
        <br><br/>
        First Name: <input type=text name=ufirst_name id="ufirst_name" required>
        <br/><br/>
        Last Name: <input type=text name=ulast_name id="ulast_name" required>
        <br/><br/>
        Email: <input type=text name=uemail id="uemail" required>
        <br/><br/>
             
        <input type="submit" value="update" name="update" id="updateButton"/>
    </form>
        
                <h2>Delete an Account:</h2>
        <p>Enter the User ID you would like to remove:</p>
         <form action="" method="POST">
        User ID: <input type=text name=delid id="delid" required>
        <br/><br/>
        <input type="submit" value="delete" name="delete" id="delButton"/>
    </form>
    </body>
</html>