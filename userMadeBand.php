<!DOCTYPE html>

<html lang="en">
  <?php
    error_reporting(E_ERROR | E_PARSE);
  session_start();
  include("config.php");
  ?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BandMates | Your Feed</title>
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

  <!-- ======= Intro Section ======= -->
  <section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="intro-img" data-aos="zoom-out" data-aos-delay="200" style="color:white;">
        <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
      </div>
        <div class='intro-info' data-aos='zoom-in' data-aos-delay='100'>
		
  
        <?php
            session_start();  
            $servername = utf8_encode("35.197.167.52");
            $dbname = utf8_encode("bandmates");
            $username = utf8_encode("root");
            $password = utf8_encode("mypassword");
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            
            if (isset($_SESSION['login_user']) == false)        //dont display form unless the user is logged in
            {
                echo "<br> You must be logged in to make a band";
            }
            else        //display form if the user is logged in
            {
                // echo "You're logged in as: " . $_SESSION['login_user'];
				// echo "<br> you're logged in, here's the form to make a band:";
				// var_dump($_POST);	//echos all post vars
				

                echo "<br> Enter data to make a band:";
                echo "  <form action=\"\" method=\"post\"> 
                            <label>Band Name</label>
                            <input name=\"bandName\" type=\"text\" placeholder=\"The Flavour Townspeople\" required>
                            <br>
                            <label>Temporary Jam Band?</label>
                            <select name=\"bandJam\" require>
                                <option value=\"0\">No</option>
                                <option value=\"1\">Yes</option>
                            </select>
							<br>
							<label>Show in feeds and searches?</label>
                            <select name=\"feedBool\" require>
								<option value=\"1\">Yes</option>
								<option value=\"0\">No</option>
							</select>";
							
				$sqlGenres = "SELECT * FROM Genres";
				$resultGenres = $conn->query($sqlGenres);
				if ($resultGenres->num_rows > 0)
				{
					echo "<br> <div> Pick Your Band Genres: <br>";
					// echo "<form action=\"genreFormTest.php\" method=\"post\">";
					while($rowC = $resultGenres->fetch_assoc())
					{
            echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"" . $rowC["genreID"] . "\" value=\"" . $rowC["genreID"] . "\">";
						// echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"genres[]\" value=\"" . $rowC["genreID"] . "\">";
						// echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
						echo "<label for=\"" . $rowC["genreID"] ."\"> " . $rowC["genreName"] . "</label> <br>";
						// echo $rowC["genreName"] . "<br>";
					}
					// echo "<input type=\"submit\">";
					echo "</div>";
					// echo "</form>";
        }
        
        $sqlInstruments = "SELECT * FROM Instruments";
				$resultInstruments = $conn->query($sqlInstruments);
				if ($resultInstruments->num_rows > 0)
				{
					echo "<br> <div> Pick Your Instruments: <br>";
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


                echo "<input type=\"submit\"> </form>";
            }

			// if( (isset($_POST['bandName']) == true) and (isset($_POST['bandGenre']) == true) and (isset($_POST['bandJam']) == true) )      //ensures that the form was sent
			if( (isset($_POST['bandName']) == true) and (isset($_POST['bandJam']) == true) )      //ensures that the form was sent
            {
                echo "<br> form submitted <br>";
                
                $currentUsername = $_SESSION['login_user'];
                $newBandName = $_POST['bandName'];
                $newBandGenre = $_POST['bandGenre'];
				$newBandJamBool = $_POST['bandJam'];
				$newBandFeedBool = $_POST['feedBool'];

                //Make the band
                $sql1 = "INSERT INTO Band (bandName, bandJamBool, bandShowInFeedBool) VALUES ('$newBandName', '$newBandJamBool', '$newBandFeedBool')";
                if ($conn->query($sql1) === TRUE) //executes "$conn->query($sql);" to run the insert
                {
                    $last_id = $conn->insert_id;
                    // echo "<br> last_id = ". $last_id . "<br>";
                } 
                else 
                {
                    echo "Error: " . $sql1 . "<br>" . $conn->error;
                }

                //Get the personID of the user to set as a bandmember
                $sqlPID = "SELECT personID FROM Person WHERE username = '$currentUsername'";
                $resultPID = $conn->query($sqlPID);
                if ($resultPID->num_rows > 0)
                {
                    while($row = $resultPID->fetch_assoc())
                    {
                        $newBandLeader = $row["personID"];
                    }
                }
                else
                {
                    echo "0 results";
                }
                
                //Make the user a bandmember
                $leaderBoolean = TRUE;
                $sql2 = "INSERT INTO BandMembers (bandID, personID, leaderBool) VALUES ('$last_id', '$newBandLeader', '$leaderBoolean')";
                if ($conn->query($sql2) === TRUE) //executes "$conn->query($sql);" to run the insert
                {
                } 
                else 
                {
                    echo "Error: " . $sql2 . "<br>" . $conn->error;
                }

                //Set genres
				$genreTable = "SELECT * FROM Genres";		//get genre table count
				$resultGenre = $conn->query($genreTable);
				$genreCount = $resultGenre->num_rows;
	
				for($loopVar = 1; $loopVar <= $genreCount; $loopVar++)
				{
					if( isset($_POST[$loopVar]) )
					{
						$postVal = $_POST[$loopVar];
						// echo "<br> post(loopvar) = " . $postVal;
	
						$sqlInsertBandGenres = "INSERT INTO BandGenres (bandID, genreID) VALUES ('$last_id', '$postVal')";    //insert the picked genres into BandGenres
						// $sqlInsertLikedGenres = "INSERT INTO LikedGenres (personID, genreID) VALUES ($gPersonID, $postVal)";    //insert the picked genres into LikedGenres

						if ($conn->query($sqlInsertBandGenres) === TRUE) //executes "$conn->query($sql);" to run the insert
						{
						} 
						else 
						{
							echo "Error: " . $sqlInsertBandGenres . "<br>" . $conn->error;
						}
					}
        }
        

        //Set instruments
        if (isset($_POST['instruments']))
            {
                $postInstruments = $_POST['instruments'];
                $postInstrumentsCount = count($postInstruments);
                for($loopVar = 0; $loopVar < $postInstrumentsCount; $loopVar++)
                {
                    $loopInstrumentID = $postInstruments[$loopVar];
                    $sqlInstrumentAdd = "INSERT INTO BandWants (bandID, instrumentID) VALUES ('$last_id','$loopInstrumentID') ";
                    $instrumentAdd = $conn->query($sqlInstrumentAdd);                
                }
            }


				// echo "<br> bandName = " . $newBandName . "<br> bandGenre = " . $newBandGenre . "<br> bandLeader = " . $newBandLeader . "<br>";
                }
                else        //if no form was sent, or loading page from external link
                {
                    echo "<br> form not submitted <br>";
                }
        ?>
          
 
        </div>
      </div>

    </div>
  </section><!-- End Intro Section -->

  <main id="main">

   
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
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

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script> 
  function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","search.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>

</body>

</html>