<!DOCTYPE html>
 <?php require_once('header.php'); ?>
 
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
                $sqlBands = "SELECT * FROM Band WHERE bandID in (SELECT bandID FROM Requests WHERE personID = '$personID' AND bandAccept=1 AND personAccept=0)";
                $resultBands = $conn->query($sqlBands);
                
                //get count of user's bands
                $sqlBandsCount = $resultBands->num_rows;
        
                $sqlBands2 = "SELECT * FROM Band WHERE bandID in (SELECT bandID FROM BandMembers WHERE personID='$personID' AND leaderBool=1)";
                $resultBands2 = $conn->query($sqlBands2);
                
                //get count of user's bands
                $sqlBandsCount2 = $resultBands2->num_rows;
               

        
                  echo " <h1>
                  New Member Requests
                   </h1>";
                  //echo "<div><h3> You have " . $sqlBandsCount2 . " people wanting to join your bands</h3> </div> <br>";
                if ($resultBands2->num_rows > 0)
                {
                    while($row2 = $resultBands2->fetch_assoc())
                    {
                        $sqlUserID = "SELECT * FROM Person WHERE personID IN (SELECT personID FROM Requests WHERE bandID=".$row2['bandID']." AND bandAccept=0 AND personAccept=1);";
                        $usersListResult = mysqli_query($conn, $sqlUserID) or die(mysqli_error($conn));
                        $querysql = mysqli_fetch_array($usersListResult, MYSQL_ASSOC);
                        
                        if (isset($querysql["personID"])){
                        echo "<div>";
                        echo "<h4>  " . $row2["bandName"] . "</h4>";
                        // echo "bandGenre = " . $row["bandGenre"] . "<br>";
                        // echo "Are you the leader? MUST BE FIXED " . $row["bandJamBool"] . "<br>";
                        // echo "(edit link)";
                        echo "<p>New Member:</p>";
                        echo "<a href=viewProfile.php?user=".$querysql['personID'].">   ".$querysql['username']."</a>";
                        echo "<form method=post action=\"acceptPerson.php?band=" .$querysql["personID"]."\">";
                            echo "<input type=hidden name=person value=".$querysql['personID'].">";
                            echo "<input type=hidden name=band value=".$row2["bandID"].">";
                        echo "<input class='btn btn-success' type=submit value='Accept Request'>";
                        echo "</form>";
                        //"<a href=\"band.php?band=" . $row["bandID"] . "\">Deny Request</a>";
                        echo "</div>";
                        echo "<br><br>";
                            }
                    }
                }
                else
                {
                    echo "You don't have any requests. Don't worry! Give it time";
                }
        
        
                 echo "<br><br>";
                 echo " <h1>
                 New Band Requests
                   </h1>";
                 // echo "<div><h3> You have " . $sqlBandsCount . " Bands that want you to join them</h3> </div> <br>";
                if ($resultBands->num_rows > 0)
                {
                    while($row = $resultBands->fetch_assoc())
                    {
                        echo "<div>";
                        echo "<h4>  " . $row["bandName"] . "</h4>";
                        // echo "bandGenre = " . $row["bandGenre"] . "<br>";
                        // echo "Are you the leader? MUST BE FIXED " . $row["bandJamBool"] . "<br>";
                        // echo "(edit link)";
                         echo "<form method=post action=\"acceptBand.php\">";
                        echo "<input type=hidden name=band value=".$row["bandID"].">";
                        echo "<input type=hidden name=person value=".$personID.">";
                        echo "<input class='btn btn-submit' type=submit value='Accept Request'>";
                        echo "</form>";
                        //"<a href=\"band.php?band=" . $row["bandID"] . "\">Deny Request</a>";
                        echo "</div>";
                        echo "<br><br>";
                    }
                }
                else
                {
                    echo "You don't have any requests. Don't worry! Give it time";
                }
            
        ?>
        </div>
        </div>
  </section><!-- End Intro Section -->

  <main id="main">
  <?php require_once('footer.php'); ?>
    </body>
</html>