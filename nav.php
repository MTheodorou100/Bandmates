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
         <li><a href='register.php'>Register</a></li>
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
        <li><a href='seachC.php'>Search</a></li>
           
           <li class='nav-item dropdown'>
           <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
             About
           </a>
           <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
             <a class='dropdown-item' href='service.php'>Terms of Service</a>
             <a class='dropdown-item' href='policy.php'>Privacy Policy</a>
           </div></li>
           <li class='nav-item dropdown'>
           <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
             My Feeds
           </a>
           <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
             <a class='dropdown-item' href='bandsThatMatchYou.php'>Bands you match</a>
             <a class='dropdown-item' href='matchesForYourBand.php'>Looking for a new Band member?</a>
           </div></li>
           <li class='nav-item dropdown'>
           <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
             Profile
           </a>
           <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
             <a class='dropdown-item' href='profile.php'>View my Profile</a>
             <a class='dropdown-item' href='viewMyBands.php'>My Bands</a>
             <div class='dropdown-divider'></div>
             <a class='dropdown-item' href='signout.php'>Sign Out</a>
           </div></li>
           
         
    </ul>
    </nav><!-- .main-nav -->
    </div>
  </header>";
  }
    
    
    ?> 