<!DOCTYPE html>
<html lang="en">
    <body>
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


            echo "<div>";
            echo "get band = " . $_GET['band'];
            echo "</div> <br>";
            $thisBandID = $_GET['band'];

            //leader checking
            $seshUser = $_SESSION['login_user'];
            echo "seshUser = " . $seshUser;
            $sqlLeaderCheck = "SELECT * FROM BandMembers WHERE personID in (SELECT personID FROM Person WHERE username = '$seshUser') AND bandID = '$thisBandID'";
            $resultLeaderCheck = $conn->query($sqlLeaderCheck);

            if($resultLeaderCheck->num_rows>0)
            {
                while($rowD = $resultLeaderCheck->fetch_assoc())
                {
                    $leaderBoolCheck = $rowD['leaderBool'];
                    if($leaderBoolCheck == 1)
                    {
                        echo "this user is a leader";
                    }
                    else
                    {
                        echo "loser, not a leader";
                    }
                }
            }
            else
            {
                echo "<br>";
                echo "you're not a member of this band";
            }
            //end leader checking



            $sqlBand = "SELECT * FROM Band WHERE bandID = '$thisBandID'";   //get band info
            $resultBand = $conn->query($sqlBand);

            $sqlBandMembers = "SELECT * FROM Person WHERE personID in (SELECT personID FROM BandMembers WHERE bandID = '$thisBandID')";      //get band members
            $resultBandMembers = $conn->query($sqlBandMembers);

            if ($resultBand->num_rows > 0)
            {
                while($row = $resultBand->fetch_assoc())
                {
                    echo "<div>";
                    echo "Band Details: <br>";
                    echo "bandID = " . $row["bandID"] . "<br>";
                    echo "bandName = " . $row["bandName"] . "<br>";
                    echo "bandGenre = " . $row["bandGenre"] . "<br>";
                    echo "Jam Band? " . $row["bandJamBool"] . "<br>";
                    echo "Are you the leader? MUST BE FIXED " . $row["bandJamBool"] . "<br>";
                    echo "</div>";

                }
                echo "<div>";
                if ($resultBandMembers->num_rows > 0)
                {
                    echo "Band Members: <br>";
                    while($rowB = $resultBandMembers->fetch_assoc())
                    {
                        echo $rowB["firstName"] . "<br>";
                    }
                }
                else
                {
                    echo "no results, there must be 0 band members";
                }
                echo "</div>";
            }
            else
            {
                echo "0 results";
            }


            // $sqlGenres = "SELECT * FROM Genres";
            // $resultGenres = $conn->query($sqlGenres);
            // if ($resultGenres->num_rows > 0)
            // {
            //     echo "<br> <div>";
            //     echo "<form action=\"genreFormTest.php\" method=\"post\">";
            //     while($rowC = $resultGenres->fetch_assoc())
            //     {
            //         echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"" . $rowC["genreID"] . "\" value=\"" . $rowC["genreID"] . "\">";
            //         // echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
            //         echo "<label for=\"" . $rowC["genreID"] ."\"> " . $rowC["genreName"] . "</label> <br>";
            //         // echo $rowC["genreName"] . "<br>";
            //     }
            //     echo "<input type=\"submit\">";
            //     echo "</div>";
            //     echo "</form>";
            // }

        ?>
    </body>
</html>