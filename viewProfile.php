<!DOCTYPE html>
<html lang="en">
    <body>

        <!-- <a href="user.php?user=56">go to test user (56)</a> -->
        <!-- <br> -->

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

            // $_SESSION['login_user']

            echo "you're logged in as: " . $_SESSION['login_user'];

            echo "<div>";
            echo "get user = " . $_GET['user'];
            echo "</div> <br>";

            $thisPersonID = $_GET['user'];

            $sqlUser = "SELECT * FROM Person WHERE personID = '$thisPersonID'";     //get viewed user information
            $resultUser = $conn->query($sqlUser);


            //Get the personID of the user to set as a bandmember
            $currentUsername = $_SESSION['login_user'];
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
            //Get the user's bands that this profile isn't a part of
            $sqlBands = "SELECT * FROM Band WHERE bandID in (SELECT bandID FROM BandMembers WHERE personID = '$personID') AND NOT bandID in (SELECT bandID FROM BandMembers WHERE personID = '$thisPersonID')";
            $resultBands = $conn->query($sqlBands);



            if ($resultUser->num_rows > 0)
            {
                while($rowA = $resultUser->fetch_assoc())
                {
                    echo "<div>";
                    echo "personID = " . $rowA["personID"] . "<br>";
                    echo "first name = " . $rowA["firstName"] . "<br>";
                    echo "surname = " . $rowA["surName"] . "<br>";
                    // echo "genre = " . $rowA["genre"] . "<br>";
                    echo "bio = " . $rowA["bio"] . "<br>";
                    echo "previous experience = " . $rowA["preExp"] . "<br>";
                    echo "email = " . $rowA["email"] . "<br>";

                    echo "<br> Add this user to one of your bands: <br>";

                    if ($resultBands->num_rows > 0)
                    {
                        echo "<form action=\"addToBand.php\" method=\"post\">";
                        echo "<select name=\"band\" require>";
                        while($rowB = $resultBands->fetch_assoc())
                        {
                            echo "<option value=\"" . $rowB["bandID"] .  "\">" .  $rowB["bandName"] . "</option>";
                        }
                        echo "<input type=\"hidden\" name=\"inviteeID\" value=\"" . $thisPersonID . "\">";
                        echo "</select>";
                        echo "<input type=\"submit\">";
                        echo $rowB["bandID"];
                    }
                    else
                    {
                        echo "0 results - you have no bands that this user isn't a part of";
                    }
                    
                    echo "</div>";
                    echo "<br>";
                }
            }
            else
            {
                echo "0 results - you have no bands that this user isn't a part of";
            }

        ?>
    </body>
</html>