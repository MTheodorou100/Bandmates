<?php
   include("config.php");
   session_start();

   if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
   }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($db,$_POST['user_name']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
       
      $sql = "SELECT * FROM Admins WHERE aUsername = '$myusername' AND aPass = '$mypassword'";
      $result = mysqli_query($db, $sql) or die(mysqli_error($db));
  
      $row = mysqli_fetch_array($result, MYSQL_ASSOC);
      if($row['aPass']==$mypassword) {
        //session_register("myusername");
        $_SESSION['adminId'] = $row['idAdmins'];
        $_SESSION['aUser'] = $row['aUsername'];

         
         header("location: admindash.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }

?>

<html>
    <body>
    <script>
    </script>
           <title>Bandmates | Admin</title>
    <h1>Admin Dashboard</h1>
    <p>Login to the dashboard by providing details:</p>
    
    <form action="" method="POST">
        Username: <input type=text name=user_name id="user_name" required>
        <br/><br/>
        Password: <input type=password name=password id="password" minlength=6 required>
        <br><br/>
        <input type="submit" value="Login" name="submit" id="loginButton"/>
    </form>
    </body>
</html>