<!DOCTYPE html>
<!-- page that displays links to bands that the user is in -->
 <?php require_once('header.php'); ?>
 <title>BandMates | My Bands</title>
<body>
<style>
.h1, h4 {
  color: white;
}
</style>

<?php require_once('nav.php'); ?>

    <body>
    <section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="intro-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
      </div>


        <h1>
            My Bands
        </h1>
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
            
                $currentUsername = $_SESSION['login_user'];
                //Get the personID of the user to set as a bandmember
                $sqlPID = "SELECT personID FROM Person WHERE username = '$currentUsername'";
                $resultPID = $conn->query($sqlPID);
                if ($resultPID->num_rows > 0)
                {
                    while($row = $resultPID->fetch_assoc())
                    {
                        $personID = $row["personID"];
                    }
                }
                else
                {
                    echo "0 results";
                }
                //Get the user's bands
                $sqlBands = "SELECT * FROM Band WHERE bandID in (SELECT bandID FROM BandMembers WHERE personID = '$personID')";
                $resultBands = $conn->query($sqlBands);
                
                //get count of user's bands
                $sqlBandsCount = $resultBands->num_rows;
                echo "<div><h2> You are a part of " . $sqlBandsCount . " bands:</h2> </div> <br>";

                if ($resultBands->num_rows > 0)
                {
                    while($row = $resultBands->fetch_assoc())
                    {
                        echo "<div class='text-white bg-primary mb-3' style='max-width: 18rem;'>";
                        echo "<div class='card-header'>  " . $row["bandName"] . "</div>";
                        // echo "bandGenre = " . $row["bandGenre"] . "<br>";
                        // echo "Are you the leader? MUST BE FIXED " . $row["bandJamBool"] . "<br>";
                        // echo "(edit link)";
                        echo "<div class='card-body text-primary'>";
                        echo "<p class='card-text'><a class='btn btn-success' href=\"band.php?band=" . $row["bandID"] . "\">View Band</a></p>";
                        echo "</div></div>";
                        echo "<br><br>";
                    }
                }
                else
                {
                    echo "0 results";
                }
            
        ?>
        </div>
        </div>
  </section><!-- End Intro Section -->

  <main id="main">
  <?php require_once('footer.php'); ?>
    </body>
</html>
