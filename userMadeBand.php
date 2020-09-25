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
            
            if (isset($_SESSION['login_user']) == false)        //dont display form unless the user is logged in
            {
                echo "<br> You must be logged in to make a band";
            }
            else        //display form if the user is logged in
            {
                echo "You're logged in as: " . $_SESSION['login_user'];
                echo "<br> you're logged in, here's the form to make a band:";
                echo "  <form action=\"\" method=\"post\"> 
                            <label>Band Name</label>
                            <input name=\"bandName\" type=\"text\" placeholder=\"The Flavour Townspeople\" required>
                            <br>
                            <label>Band Genre</label>
                            <select name=\"bandGenre\" require>
                                <option value=\"Rock\">Rock</option>
                                <option value=\"Jazz\">Jazz</option>
                                <option value=\"Metal\">Metal</option>
                                <option value=\"RnB\">RnB</option>
                            <br>
                            <input type=\"submit\">
                        </form>";
            }

            if( (isset($_POST['bandName']) == true) and (isset($_POST['bandGenre']) == true) )      //ensures that the form was sent
            {
                echo "<br> form submitted <br>";

                $currentUsername = $_SESSION['login_user'];
                $newBandName = $_POST['bandName'];
                $newBandGenre = $_POST['bandGenre'];

                //Make the band
                $sql1 = "INSERT INTO Band (bandName, bandGenre) VALUES ('$newBandName', '$newBandGenre')";
                if ($conn->query($sql1) === TRUE) //executes "$conn->query($sql);" to run the insert
                {
                    $last_id = $conn->insert_id;
                    echo "<br> last_id = ". $last_id . "<br>";
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

                echo "<br> bandName = " . $newBandName . "<br> bandGenre = " . $newBandGenre . "<br> bandLeader = " . $newBandLeader . "<br>";
            }
            else        //if no form was sent, or loading page from external link
            {
                echo "<br> form not submitted <br>";
            }
        ?>
    </body>
</html>