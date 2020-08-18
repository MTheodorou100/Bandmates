<?php
   include("config.php");
   session_start();
   
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

         
         header("location: home.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<html>
   
   <head>
      <title>Login</title>
      <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
      <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	   <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
   </head>
   
   <body class="text-center">
	   
	   <form class="form-signin" action = "" method = "post">
	   <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

	   <label for="inputEmail" class="sr-only">Email address</label>
	   <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
	   <label for="inputPassword" class="sr-only">Password</label>
	   <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
	   
	   <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>               

	   <?php echo $error; ?>
	   
	   </form>
   </body>
</html>
