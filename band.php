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

            $sqlBand = "SELECT * FROM Band WHERE bandID = '$thisBandID'";
            $resultBand = $conn->query($sqlBand);

            if ($resultBand->num_rows > 0)
            {
                while($row = $resultBand->fetch_assoc())
                {
                    echo "<div>";
                    echo "bandID = " . $row["bandID"] . "<br>";
                    echo "bandName = " . $row["bandName"] . "<br>";
                    echo "bandGenre = " . $row["bandGenre"] . "<br>";
                    echo "Are you the leader? " . $row["bandJamBool"] . "<br>";
                    echo "</div>";
                    echo "<br>";
                }
            }
            else
            {
                echo "0 results";
                }

        ?>
    </body>
</html>