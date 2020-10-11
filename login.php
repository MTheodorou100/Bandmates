<?php
   include("config.php");
   session_start();

   if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
   }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT username FROM Person WHERE username = '$myusername' AND password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result);
      $active = $row['active'];

      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        //session_register("myusername");
        $_SESSION['login_user'] = $myusername;
        $now = new DateTime();
	    $newDate = $now->format('Y-m-d H:i:s');
        $sql2 = "UPDATE Person SET lastLoginTime='$newDate' WHERE username='$_SESSION[login_user]'";
        $result = mysqli_query($db, $sql2) or die(mysqli_error($db));

         
         header("location: index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>




<html lang="en">

<?php require_once('header.php'); ?>

<body>
<?php require_once('nav.php'); ?> 

    <section id="intro" class="clearfix">
    <div class="container">
        <h2 class="white">Login</h2>
        <form action="" method="post">
            <div class="form-group">
                <label class="white">Username</label>
                <input type="text" name="username" >
            </div>    
            <div class="form-group">
                <label class="white">Password</label>
                <input type="password" name="password" >
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p class="white">Don't have an Account? <a href="register.php">Sign up here!</a>.</p>
        </form>
    </div>    
        </section>
</body>
<?php require_once('footer.php'); ?>
</html>