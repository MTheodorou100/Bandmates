            <?php   
            session_start();    
include("config.php");
if(isset($_POST['submit'])){
$servername = utf8_encode("35.197.167.52");
$dbname = utf8_encode("bandmates");
$username = utf8_encode("root");
$password = utf8_encode("mypassword");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}     

$fname = $_POST['fname'];
$lname= $_POST['lname'];
$username= $_SESSION['login_user'];
   $bio = $_POST['bio'];
   $pexp = $_POST['pexp'];

$sql = "UPDATE Person SET firstName='$_POST[fname]', surName='$_POST[lname]', bio='$_POST[bio]', preExp='$_POST[pexp]', email='$_POST[email]' WHERE username='$_SESSION[login_user]'";
$result = mysqli_query($db, $sql) or die(mysqli_error($db));
    
     $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
      $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
      $querysql = mysqli_fetch_array($usersListResult, MYSQL_ASSOC);
                 
    foreach($_POST['instruments'] as $loopInstrumentID) {
        $sqlInstrumentDelete = "DELETE FROM Plays WHERE personID='$querysql[personID]'AND instrumentID='$loopInstrumentID';";
        $InsDel = mysqli_query($db, $sqlInstrumentDelete) or die(mysqli_error($db));
    }
    
    foreach($_POST['genreArrayA'] as $loopGenreID) {
       //$sqlGenreDelete = "INSERT INTO LikedGenres (personID, genreID) VALUES ('$querysql[personID]','$loopGenreID');";
       $sqlGenreDelete = "DELETE FROM LikedGenres WHERE personID='$querysql[personID]'AND genreID='$loopGenreID';";
        $GenDel = mysqli_query($db, $sqlGenreDelete) or die(mysqli_error($db));
    }
  
  foreach($_POST['instruments2'] as $loopInstrumentID) {
        $sqlInstrumentAdd = "INSERT INTO Plays (personID, instrumentID) VALUES ('$querysql[personID]','$loopInstrumentID');";
        $insertIntoBandWants = mysqli_query($db, $sqlInstrumentAdd) or die(mysqli_error($db));
    }
    
    foreach($_POST['genreArray2'] as $loopGenreID) {
        $sqlGenreAdd = "INSERT INTO LikedGenres (personID, genreID) VALUES ('$querysql[personID]','$loopGenreID');";
        $insertIntoBandWants = mysqli_query($db, $sqlGenreAdd) or die(mysqli_error($db));
    }

   header("location: profile.php");
}

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

  <title>BandMates | Edit your Profile</title>
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
        <p class="white">Fill in your details and modify your Profile</p>
   		 <form onsubmit="return validate()" action="" method='POST'>

  <label class="white" for="firstname">First Name:</label>

  <input id="fname" name="fname" type="text" onchange="livefnamevalidate()">
  <label id="lblfname" style="color: red; visibility: hidden;"> Please enter first name</label>
  <br><br>
             
  <label class="white" for="lastname">Last Name:</label>
  <input id="lname" name="lname" type="text" onchange="livelnamevalidate()">
  <label id="lbllname" style="color: red; visibility: hidden;"> Please enter last name</label>
  <br><br>
             
           
        
           
             
             

             
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
            <br>   
           <h2 class="white">Modify Instruments</h2>   
           <?php
           $servername = utf8_encode("35.197.167.52");
           $dbname = utf8_encode("bandmates");
           $username = utf8_encode("root");
           $password = utf8_encode("mypassword");
           $conn = new mysqli($servername, $username, $password, $dbname);
           if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
           }     
            $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
            $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
            $querysql = mysqli_fetch_array($usersListResult, MYSQL_ASSOC);
           
            $sqlInstruments = "SELECT * FROM Instruments WHERE instrumentID IN (SELECT instrumentID FROM Plays WHERE personID='$querysql[personID]')";
				$resultInstruments = $conn->query($sqlInstruments);
				if ($resultInstruments->num_rows > 0)
				{
					echo "<div> Select Instruments to Remove from your profile: <br>";
					// echo "<form action=\"genreFormTest.php\" method=\"post\">";
					while($rowD = $resultInstruments->fetch_assoc())
					{
						echo "<input type=\"checkbox\" id=\"i" . $rowD["instrumentID"] . "\" name=\"instruments[]\" value=\"" . $rowD["instrumentID"] . "\">";
						// echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
						echo "<label for=\"i" . $rowD["instrumentID"] ."\"> " . $rowD["instrumentName"] . "</label> <br>";
						// echo $rowC["genreName"] . "<br>";
					}
					// echo "<input type=\"submit\">";
					echo "</div>";
					// echo "</form>";
        }
           
           $sqlInstruments2 = "SELECT * FROM Instruments WHERE instrumentID NOT IN (SELECT instrumentID FROM Plays WHERE personID='$querysql[personID]')";
				$resultInstruments2 = $conn->query($sqlInstruments2);
				if ($resultInstruments->num_rows > 0)
				{
					echo "<div> Select Instruments to Add to your profile: <br>";
					// echo "<form action=\"genreFormTest.php\" method=\"post\">";
					while($rowD = $resultInstruments2->fetch_assoc())
					{
						echo "<input type=\"checkbox\" id=\"i" . $rowD["instrumentID"] . "\" name=\"instruments2[]\" value=\"" . $rowD["instrumentID"] . "\">";
						// echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
						echo "<label for=\"i" . $rowD["instrumentID"] ."\"> " . $rowD["instrumentName"] . "</label> <br>";
						// echo $rowC["genreName"] . "<br>";
					}
					// echo "<input type=\"submit\">";
					echo "</div>";
					// echo "</form>";
        }
    
    
    
                     echo "<div>";
           
           echo "<h2 class=white>Modify Genres</h2>";
                    // $sqlGenres = "SELECT * FROM Genres";
            $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
            $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
           
                    $sqlGenres = "SELECT * FROM Genres WHERE genreID IN (SELECT genreID FROM LikedGenres WHERE personID='$querysql[personID]')";
				    $resultGenres = $conn->query($sqlGenres);
                    if ($resultGenres->num_rows > 0)
                    {
                        echo "Select Genres to Remove from your profile:<br>";
                        // echo "<form action=\"genreFormTest.php\" method=\"post\">";
                        while($rowC = $resultGenres->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"g" . $rowC["genreID"] . "\" name=\"genreArrayA[]\" value=\"" . $rowC["genreID"] . "\">";
                            // echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
                            echo "<label for=\"g" . $rowC["genreID"] ."\"> " . $rowC["genreName"] . "</label> <br>";
                            // echo $rowC["genreName"] . "<br>";
                        }
                        // echo "<input type=\"submit\">";
                        // echo "</div>";
                        // echo "</form>";
                    }
           
           
            $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
            $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
           
                    $sqlGenres2 = "SELECT * FROM Genres WHERE genreID NOT IN (SELECT genreID FROM LikedGenres WHERE personID='$querysql[personID]')";
				    $resultGenres2 = $conn->query($sqlGenres2);
                    if ($resultGenres2->num_rows > 0)
                    {
                        echo "Select Genres to Add to your profile:<br>";
                        // echo "<form action=\"genreFormTest.php\" method=\"post\">";
                        while($rowC = $resultGenres2->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"g" . $rowC["genreID"] . "\" name=\"genreArray2[]\" value=\"" . $rowC["genreID"] . "\">";
                            // echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
                            echo "<label for=\"g" . $rowC["genreID"] ."\"> " . $rowC["genreName"] . "</label> <br>";
                            // echo $rowC["genreName"] . "<br>";
                        }
                        // echo "<input type=\"submit\">";
                        // echo "</div>";
                        // echo "</form>";
                    }
             
    ?>  
             
 <button class="button-register" name="submit" type="submit" href="">Make Changes</button>
         
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