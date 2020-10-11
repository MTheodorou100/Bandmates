   <?php   
            session_start();         
            ?><html lang="en">

<head>

    
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

<?php require_once('header.php'); ?>

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
                <input name="username" id="uname" type="text" onchange="liveuservalidate()">
                <label id="lbluser" style="color: red; visibility: hidden;"> Please enter a username</label>
                <br><br>
            
                <label class="white">Password</label>
                <input name="password" id="pass" type="password" onchange="livepassvalidate()">
                <label id="lblpass" style="color: red; visibility: hidden;"> Please enter a password</label>
                <br><br>
                
            <label class="white" for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday">
          <br><br>
          
                <label class="white">Confirm Password</label>
                <input name="confirm_password" id="confirmpass" type="password">
                <label id="lblconpass" style="color: red; visibility: hidden;"> Please enter matching password</label>
                <br><br>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-dark" value="Reset">
            </div>
            <p class="white" >Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
        </section>
</body>
<?php require_once('footer.php'); ?>
</html>