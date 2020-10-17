<!DOCTYPE html>
<html lang="en">
    <body>
        <!-- This page is for adding new memebers to the band -->
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


            $bandID = $_POST['band'];
            $newBandMember = $_POST['inviteeID'];

            //Request to Add BandMember
            $personAccept = 0;
            $bandAccept = 1;
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
