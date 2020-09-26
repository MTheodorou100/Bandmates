<!DOCTYPE html>
<html lang="en">
    <body>
        <h1>
            userMadeBand Page
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
            
            



            if (isset($_SESSION['login_user']) == false)        //dont display unless the user is logged in
            {
                echo "<br> You must be logged in to view your bands";
            }
            else        //display bands if the user is logged in
            {
                echo "You're logged in as: " . $_SESSION['login_user'];
                
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
                $sqlBands = "SELECT * FROM bandmates.Band WHERE bandID in (SELECT bandID FROM bandmates.BandMembers WHERE personID = '$personID')";
                $resultBands = $conn->query($sqlBands);
                if ($resultBands->num_rows > 0)
                {
                    while($row = $resultBands->fetch_assoc())
                    {
                        $personID = $row["personID"];
                        echo "<div>";
                        echo "bandID = " . $row["bandID"];
                        echo "bandName = " . $row["bandName"];
                        echo "bandGenre = " . $row["bandGenre"];
                        echo "Are you the leader? " . $row["bandJamBool"];
                        echo "(edit link)";
                        echo "</div>";
                    }
                }
                else
                {
                    echo "0 results";
                }
            }
        ?>
    </body>
</html>