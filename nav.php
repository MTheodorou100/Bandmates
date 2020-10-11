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

        <li><a href='index.php'>Home</a></li>
        <li><a href='service.php'>Terms of Service</a></li>
         <li><a href='policy.php'>Privacy Policy</a></li>
         <li><a href='profile.php'>My Profile</a></li>
         <li><a href='login.php'> Login </a></li>
             
        </ul>
        
        
      </nav><!-- .main-nav -->
      </div>
    </header>";

  } else {
    echo "<header id='header' class='fixed-top'>
<div class='container'>
  <div class='logo float-left'>
    <!-- Uncomment below if you prefer to use an text logo -->
    <!-- <h1><a href='index.php'>NewBiz</a></h1> -->
    <a href='index.php'><img src='assets/img/logo.png' alt='' class='img-fluid'></a>
    <a href='index.php'>Logged in as ".$_SESSION['login_user']." </a>                               
  </div>
  <nav class='main-nav float-right d-none d-lg-block'>
    <ul>
      
             <li ><a href='index.php'>Home</a></li>
        <li><a href='makeBand.php'>Create a Band</a></li>
        <li><a href='viewMyBands.php'>View my Bands</a></li>
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