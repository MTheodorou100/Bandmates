<!DOCTYPE html>
<html lang="en">
    <body>
        <h1>
            viewBands Page
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
                echo "<div> You're logged in as: " . $_SESSION['login_user'] . "</div> <br>";
                
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
                //get count of user's bands
                //Get the user's bands
                $sqlBands = "SELECT * FROM Band WHERE bandID in (SELECT bandID FROM BandMembers WHERE personID = '$personID')";
                $resultBands = $conn->query($sqlBands);

                $sqlBandsCount = $resultBands->num_rows;
                echo "<div> You are a part of " . $sqlBandsCount . " bands: </div> <br>";

                if ($resultBands->num_rows > 0)
                {
                    while($row = $resultBands->fetch_assoc())
                    {
                        echo "<div>";
                        echo "bandID = " . $row["bandID"] . "<br>";
                        echo "bandName = " . $row["bandName"] . "<br>";
                        echo "bandGenre = " . $row["bandGenre"] . "<br>";
                        echo "Are you the leader? " . $row["bandJamBool"] . "<br>";
                        // echo "(edit link)";
                        echo "<a href=\"band.php?band=" . $row["bandID"] . "\">edit link</a>";
                        echo "</div>";
                        echo "<br>";
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