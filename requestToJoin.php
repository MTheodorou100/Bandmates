<!DOCTYPE html>
<html lang="en">
    <!-- Page to process the requests to join bands -->
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


            $bandID = $_POST['join'];
            $newBandMember = $_POST['uid'];

            //Request to Join
            $personAccept = 1;
            $bandAccept = 0;
            //$sql2 = "INSERT INTO BandMembers (bandID, personID, leaderBool) VALUES ('$bandID', '$newBandMember', '$leaderBoolean')";
            $sql2 = "INSERT INTO Requests (bandID, personID, bandAccept, personAccept) VALUES ('$bandID', '$newBandMember', '$bandAccept', '$personAccept')";
            if ($conn->query($sql2) === TRUE)   //executes "$conn->query($sql2);" to run the insert
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
