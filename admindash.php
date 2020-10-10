<?php
   include("config.php");
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
    <body>
    
    
               <style>  
h1 {
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
h2 {
  color: black;
  font-family: verdana;
}
body {
  background-color: blue;
}
       </style>
    <h1 class="display-1 text-center">Admin Dashboard</h1>
            <title>Bandmates | Admin</title>
    <h2 class="display-2 text-center">Welcome back <?php echo $_SESSION['aUser']; ?></h2>

    <ul class="nav nav-pills nav-fill">
   <li class="nav-item btn-dark">
    <a class="nav-link text-white" href="adminaccounts.php">View Admin Accounts</a>
   </li>
   <li class="nav-item btn-dark">
    <a class="nav-link text-white" href="adminmembers.php">View Member Accounts</a>
   </li>
   <li class="nav-item btn-dark">
    <a class="nav-link text-white" href="adminbands.php">View Bands</a>
   </li>
   <li class="nav-item btn-dark">
    <a class="nav-link text-white" href="signout.php">Logout</a>
   </li>
   </ul>
   <br><br><br>
   <section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="intro-img" data-aos="zoom-out" data-aos-delay="200" style="color:white;">
        <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
      </div>
        <div class='intro-info' data-aos='zoom-in' data-aos-delay='100'>
   
    </body>
</html>