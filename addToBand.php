<!DOCTYPE html>
<html lang="en">
    <body>

        <?php
            // error_reporting(E_ERROR | E_PARSE);
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

            // session_start();
            // echo "<br>";

            // echo "post inviteeID" . $_POST['inviteeID'];
            // echo "post band = " . $_POST['band'];

            $bandID = $_POST['band'];
            $newBandMember = $_POST['inviteeID'];

            //Make the user a bandmember
            $leaderBoolean = 0;
            $sql2 = "INSERT INTO BandMembers (bandID, personID, leaderBool) VALUES ('$bandID', '$newBandMember', '$leaderBoolean')";
            if ($conn->query($sql2) === TRUE) //executes "$conn->query($sql);" to run the insert
            {
                // echo "Person added to band!";
                header("Location: band.php?band=".$bandID);
            } 
            else 
            {
                // echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        ?>

    </body>
</html>