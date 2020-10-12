<!DOCTYPE html>
<html lang="en">
    <body>
        <?php
            include("config.php");
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
            $newBandMember = $_POST['person'];

            //Request to Add BandMember
            $leaderBoolean = 0;
            $joinedBoolean = 1;
            $sql2 = "INSERT INTO BandMembers (bandID, personID, leaderBool) VALUES ('$bandID', '$newBandMember', '$leaderBoolean')";  
        
            $sqlUserID2 = "UPDATE Requests SET bandAccept='$joinedBoolean' WHERE personID='$newBandMember' AND bandID='$bandID';";
            $usersListResult2 = mysqli_query($db, $sqlUserID2) or die(mysqli_error($db));
            $querysql2 = mysqli_fetch_array($usersListResult2, MYSQL_ASSOC);
        
        
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