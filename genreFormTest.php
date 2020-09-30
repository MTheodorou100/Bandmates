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
            
            //get genre table count
            $genreTable = "SELECT * FROM Genres";
            $resultGenre = $conn->query($genreTable);
            $genreCount = $resultGenre->num_rows;

            for($loopVar = 1; $loopVar <= $genreCount; $loopVar++)
            {
                if( isset($_POST[$loopVar]) )
                {
                    $postVal = $_POST[$loopVar];
                    echo "<br> post(loopvar) = " . $postVal;

                    $sqlInsertBandGenres = "INSERT INTO BandGenres (bandID, genreID) VALUES ($gBandID, $postVal)";    //insert the picked genres into BandGenres
                    $sqlInsertLikedGenres = "INSERT INTO LikedGenres (personID, genreID) VALUES ($pBandID, $postVal)";    //insert the picked genres into LikedGenres
                }
            }
        ?>
    </body>
</html>