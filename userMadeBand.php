<!DOCTYPE html>
<html lang="en">
    <body>
        <h1>
            userMadeBand Page
        </h1>
        <h2>
            (SHOULD ONLY LOAD IF USER IS LOGGED IN AND IN SESSION)
        </h2>
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
            
            $newBandName = $_POST['bandName'];
            $newBandGenre = $_POST['bandGenre'];
            $newBandLeader = $_POST['bandLeader'];
            echo "<br> bandName = " . $newBandName . "<br> bandGenre = " . $newBandGenre . "<br> bandLeader = " . $newBandLeader . "<br>";
            
            // $_SESSION['login_user'] = "el poopy";

            if ( $_SESSION['login_user']==null)
            {
                echo "You must be logged in to make a band";
            }
            else
            {
                echo "you're logged in, FORM GOES HERE";
            }
        ?>

        <form action="" method="post"> 
            <label>Band Name</label>
            <input name="bandName" type="text" placeholder="The Flavour Townspeople" required>
            <br>
            <label>Band Genre</label>
            <input name="bandGenre" type="text" placeholder="Post-Industrial" required>
            <br>
            <label>Band Leader</label>
            <input name="BandLeader" type="text" value="<?php echo $_SESSION['login_user'] ?>" required readonly>
            <br>
            <input type="submit">
        </form>
    </body>
</html>