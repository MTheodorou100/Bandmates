   <?php   
            session_start();         
            ?><html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
  <script type="text/javascript">
    
  function validate() 
    {
        var username = document.getElementById("uname");
        var password = document.getElementById("pass");
        var conpassword = document.getElementById("confirmpass");
        
        if(username.value.trim() =="")
          {  
            //alert("Blank username");
            username.style.border = "solid 3px red";
            document.getElementById("lbluser").style.visibility="visible";
            return false;
          }
       else if(password.value.trim() =="")
          {
            //alert("Blank password");
            password.style.border = "solid 3px red";
            document.getElementById("lblpass").style.visibility="visible";
            return false;  
          }
       else if(conpassword.value.trim() =="" || conpassword.value.trim() != password.value.trim())
          {
            //alert("Blank confirm password");
            conpassword.style.border = "solid 3px red";
            document.getElementById("lblconpass").style.visibility="visible";
            return false;   
          }
       else
          {
            return true;
          }
    }
      
  function liveuservalidate()
      {
          var username = document.getElementById("uname");
          
          if(username.value.trim() != "")
          {
              username.style.border = "solid 3px green";
              document.getElementById("lbluser").style.visibility="hidden";
          }
        else
          {
              username.style.border = "solid 3px red";
              document.getElementById("lbluser").style.visibility="visible";
          }
    }
    
  function livepassvalidate()
      {
          var password = document.getElementById("pass");
          
          if(password.value.trim() != "")
          {
              password.style.border = "solid 3px green";
              document.getElementById("lblpass").style.visibility="hidden";
          }
        else
          {
              password.style.border = "solid 3px red";
              document.getElementById("lblpass").style.visibility="visible";
          }
    }
      
//    function liveconpassvalidate()
//      {
//          var conpassword = document.getElementById("confirmpass");
//          
//          if(conpassword.value == password.value)
//          {
//              conpassword.style.border = "solid 3px green";
//              document.getElementById("lblconpass").style.visibility="hidden";
//              document.getElementById("conpasserror").style.visibility="hidden";
//          }
//        else
//          {
//              conpassword.style.border = "solid 3px red";
//              document.getElementById("conpasserror").style.visibility="visible";
//          }
//    }    
      
    
  </script>

  <title>BandMates | Register</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NewBiz - v2.1.0
  * Template URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php
    if ( $_SESSION['login_user']==null){
    echo "<header id='header' class='fixed-top'>
    <div class='container'>

      <div class='logo float-left'>
        <!-- Uncomment below if you prefer to use an text logo -->
        <!-- <h1><a href='index.html'>NewBiz</a></h1> -->
        <a href='index.php'><img src='assets/img/logo.png' alt='' class='img-fluid'></a>
      </div>

      <nav class='main-nav float-right d-none d-lg-block'>
        <ul>

          
          <li class='active'><a href='index.php'>Home</a></li>
          <li><a href='login.php'>Login</a></li>
          <li><a href='register.php'>Register</a></li>
            <li><a href='service.php'>Terms of Service</a></li>
             <li><a href='policy.php'>Privacy Policy</a></li>
        </ul>
      </nav><!-- .main-nav -->
      </div>
    </header>";
    } else {
        echo "<header id='header' class='fixed-top'>
    <div class='container'>

      <div class='logo float-left'>
        <!-- Uncomment below if you prefer to use an text logo -->
        <!-- <h1><a href='index.html'>NewBiz</a></h1> -->
        <a href='index.php'><img src='assets/img/logo.png' alt='' class='img-fluid'></a>
        <a href='index.php'>Logged in as ".$_SESSION['login_user']." </a>                               
      </div>


      <nav class='main-nav float-right d-none d-lg-block'>
        <ul>

          
          <li class='active'><a href='index.php'>Home</a></li>
            <li><a href='service.php'>Terms of Service</a></li>
             <li><a href='policy.php'>Privacy Policy</a></li>
             <li><a href='profile.php'>My Profile</a></li>
             <li><a href='signout.php'> Sign Out </a></li>
             
        </ul>
        
        
      </nav><!-- .main-nav -->
      </div>
    </header>";
    }
    
    ?>  
        

    <section id="intro" class="clearfix">
    <div class="container">
        <h2 class="white">Sign Up</h2>
        <p class="white">Please fill this form to create an account.</p>
        <form onsubmit="return validate()" action="registers.php" method="post">
                <label class="white">Username</label>
                <input id="uname" type="text" onchange="liveuservalidate()">
                <label id="lbluser" style="color: red; visibility: hidden;"> Please enter a username</label>
                <br><br>
            
                <label class="white">Password</label>
                <input id="pass" type="password" onchange="livepassvalidate()">
                <label id="lblpass" style="color: red; visibility: hidden;"> Please enter a password</label>
                <br><br>
                
                <label class="white">Confirm Password</label>
                <input id="confirmpass" type="password">
                <label id="lblconpass" style="color: red; visibility: hidden;"> Please enter matching password</label>
                <br><br>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p class="white" >Already have an account? <a href="login.html">Login here</a>.</p>
        </form>
    </div>    
        </section>
</body>
    
    
    
    
    
    
    
    
      <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A410 Morobe Street <br>
              Heidelberg West, Victoria<br>
              Australia <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> support@xpertmenace.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>BandMates</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=NewBiz
      -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->
</html>