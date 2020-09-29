            <?php   
            session_start();         
            ?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
  <script type="text/javascript">
      
  function validate()
    {
        var firstname = document.getElementById("fname");
        var lastname = document.getElementById("lname");
        var textarea = document.getElementById("bio");
        var textarea2 = document.getElementById("pexp");
        
        if(firstname.value.trim() =="")
          {  
            //alert("Blank username");
            firstname.style.border = "solid 3px red";
            document.getElementById("lblfname").style.visibility="visible";
            return false;
          }
       else if(lastname.value.trim() =="")
          {
            //alert("Blank password");
            lastname.style.border = "solid 3px red";
            document.getElementById("lbllname").style.visibility="visible";
            return false;  
          }
       else if(textarea.value.trim() =="")
          {
            //alert("Blank password");
            textarea.style.border = "solid 3px red";
            document.getElementById("lbltxtarea").style.visibility="visible";
            return false;  
          }
       else if(textarea2.value.trim() =="")
          {
            //alert("Blank password");
            textarea2.style.border = "solid 3px red";
            document.getElementById("lbltxtarea2").style.visibility="visible";
            return false;
          }
        else
          {
            return true;
          }
    }
      
    function livefnamevalidate()
      {
          var firstname = document.getElementById("fname");
          
          if(firstname.value.trim() != "")
          {
              firstname.style.border = "solid 3px green";
              document.getElementById("lblfname").style.visibility="hidden";
          }
        else
          {
              firstname.style.border = "solid 3px red";
              document.getElementById("lblfname").style.visibility="visible";
          }
    }
    
  function livelnamevalidate()
      {
          var lastname = document.getElementById("lname");
          
          if(lastname.value.trim() != "")
          {
              lastname.style.border = "solid 3px green";
              document.getElementById("lbllname").style.visibility="hidden";
          }
        else
          {
              lastname.style.border = "solid 3px red";
              document.getElementById("lbllname").style.visibility="visible";
          }
      }
          
  function livebiovalidate()
      {
          var textarea = document.getElementById("bio");
          
          if(textarea.value.trim() != "")
          {
              textarea.style.border = "solid 3px green";
              document.getElementById("lbltxtarea").style.visibility="hidden";
          }
        else
          {
              textarea.style.border = "solid 3px red";
              document.getElementById("lbltxtarea").style.visibility="visible";
          }
      }
          
  function livepbevalidate()
      {
          var textarea2 = document.getElementById("pexp");
          
          if(textarea2.value.trim() != "")
          {
              textarea2.style.border = "solid 3px green";
              document.getElementById("lbltxtarea2").style.visibility="hidden";
          }
        else
          {
              textarea2.style.border = "solid 3px red";
              document.getElementById("lbltxtarea2").style.visibility="visible";
          }
    }
      
    </script>

  <title>BandMates | Create a Profile</title>
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

  <!-- ======= Header ======= -->
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
        <h2 class="white">Edit Profile</h2>
        <p class="white">Fill in your details to create your Profile</p>
   		 <form onsubmit="return validate()" action="cprofile.php" method='POST'>

  <label class="white" for="firstname">First Name:</label>

  <input id="fname" name="fname" type="text" onchange="livefnamevalidate()">
  <label id="lblfname" style="color: red; visibility: hidden;"> Please enter first name</label>
  <br><br>
             
  <label class="white" for="lastname">Last Name:</label>
  <input id="lname" name="lname" type="text" onchange="livelnamevalidate()">
  <label id="lbllname" style="color: red; visibility: hidden;"> Please enter last name</label>
  <br><br>
             
             

<div class="instrument">
  <label class="white" for="instrumentSelect">Instrument Played:</label>
	<select name="instrument" id='instrument'>
                    <option value="Guitar">Guitar</option>
                    <option value="Bass Guitar">Bass Guitar</option>
                    <option value="Drums">Drums</option>
                    <option value="Vocals">Vocals</option>
    </select>
    <br><br>
</div>

<div class="genre">
  <label class="white" for="genreSelect">Preferred Genre:</label>
	<select name="genre" id='genre'>
                    <option value="Rock">Rock</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Metal">Metal</option>
                    <option value="RnB">RnB</option>
    </select>
    <br><br>
</div>
            
    <div class="position">
  <label class="white" for="positionSelect">Preferred Position:</label>
	<select name="position" id='position'>
                    <option value="Guitarist">Guitarist</option>
                    <option value="Drummer">Drummer</option>
                    <option value="Lead Vocals">Lead Vocals</option>
                    <option value="Keyboardist">Keyboardist</option>
    </select>
    <br><br>
</div>
             
    <div class="bio">
  <label class="white" for="Bio">Bio (Tell us about yourself):</label><br>
    <textarea name="bio" id='bio' rows="4" cols="50" onchange="livebiovalidate()"></textarea>
    <label id="lbltxtarea" style="color: red; visibility: hidden;"> Please enter details in the text box provided</label>
    </div>  
             
    <div class="pexp">
  <label class="white" for="pexp">Write about your previous Band Experiences:</label><br>
    <textarea name="pexp" id='pexp' rows="4" cols="50" onchange="livepbevalidate()"></textarea>
    <label id="lbltxtarea2" style="color: red; visibility: hidden;"> Please enter details in the text box provided</label>
    </div>
             
<div class="email">
  <label class="white" for="email">Contact Email:</label>
  <input type="email" id="email" name="email" class="form-control">
</div>

            
    <div class="position">
  <label class="white" for="positionSelect">Preferred Position:</label>
	<select name="position" id='position'>
                    <option value="Guitarist">Guitarist</option>
                    <option value="Drummer">Drummer</option>
                    <option value="Lead Vocals">Lead Vocals</option>
                    <option value="Keyboardist">Keyboardist</option>
    </select>
</div>

            
            <div class="bio">
               
  <label class="white" for="Bio">Bio (Tell us about yourself):</label>
               <br>
	<textarea name="bio" id='bio' rows="4" cols="50">

    </textarea>
</div>
            
<div class="pexp">
   <br>
  <label class="white" for="pexp">Write about your previous Band Experiences:</label>
   <br>
	<textarea name="pexp" id='pexp' rows="4" cols="50">

    </textarea>
</div>

<div class="email">
  <label class="white" for="email">Contact Email:</label>
  <input type="text" id="email" name="email" class="form-control">
</div>

            <br>                       
 <button class="button-register" type="submit" href="home.html">Register</button>
         
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