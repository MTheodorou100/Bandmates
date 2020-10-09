<html>
    <body>
        <?php
            session_start();
        
            include("config.php");

            //Step 1: Get all users that play any instruments the band wants
            $sqlUsersList = "SELECT * FROM Person WHERE personID IN (SELECT personID FROM Plays WHERE instrumentID IN (SELECT instrumentID FROM BandWants WHERE bandID = 21));";
            $usersListResult = mysqli_query($db, $sqlUsersList) or die(mysqli_error($db));
            $userArray;
            $loopValA = 0;
            
            while ($row = mysqli_fetch_array($usersListResult, MYSQL_ASSOC))
            {
                $userArray[$loopValA][0] = $row['personID'];
                $userArray[$loopValA][1] = $row['firstName'];
                $userArray[$loopValA][2] = $row['surName'];
                $userArray[$loopValA][3] = $row['username'];
        
                $loopValA++;
            }
            //^ User Array Key:
            //$userArray[0][0] = PersonID
            //$userArray[0][1] = First Name
            //$userArray[0][2] = SurName
            //$userArray[0][3] = User Name
            //$userArray[0][4] = Score   


        
            //Step 2: Genre score loop (from 0 to 100)

            //Retrieve Number of Band Genres
            $usersListResult = mysqli_query($db, $sqlUsersList) or die(mysqli_error($db));
            $numBandGenres = "SELECT COUNT(genreID) FROM BandGenres WHERE bandID = 21;";
            $numBandGenreResult = mysqli_query($db, $numBandGenres) or die(mysqli_error($db));
            $v3 = mysqli_fetch_array($numBandGenreResult, MYSQL_ASSOC);
            $numBaGenres = $v3['COUNT(genreID)'];

            $loopValB=0;
            while ($rowB = mysqli_fetch_array($usersListResult, MYSQL_ASSOC))
            {
                //Retrieve Number of Player Genres
                $numPlayerGenres = "SELECT COUNT(genreID) FROM LikedGenres WHERE personID = ".$rowB['personID'].";";
                $numPlayerGenresResult = mysqli_query($db, $numPlayerGenres) or die(mysqli_error($db));
                $v1 = mysqli_fetch_array($numPlayerGenresResult, MYSQL_ASSOC);
                $numPlGenres = $v1['COUNT(genreID)'];
                
                //Retrieve Number of Matches
                $numMatches = "SELECT COUNT(genreID) FROM BandGenres WHERE genreID IN (SELECT genreID FROM LikedGenres WHERE personID = ".$rowB['personID']." ) AND bandID = 21";
                $numMatchesResult = mysqli_query($db, $numMatches) or die(mysqli_error($db));
                $v2 = mysqli_fetch_array($numMatchesResult, MYSQL_ASSOC);
                $numMatches = $v2['COUNT(genreID)'];
                
                // $numPlGenres =   10;  //test vars
                // $numBaGenres   =   6;
                // $numMatches     =   4;

                // echo "personID: ".$userArray[$loopValB][0];
                // echo '<br>';
                // echo "Username: ".$userArray[$loopValB][3];
                // echo '<br>';
                // echo '<br>';
                // echo "numPlGenres pre calc:".$numPlGenres;
                // echo '<br>';
                // echo "numMatches pre calc:".$numMatches;
                // echo '<br>';
                // echo "numBaGenres pre calc:".$numBaGenres;
                // echo '<br>';
                // echo '<br>';

                $newBaGenres    = $numBaGenres * 100;       //multiply by 100
                $newMatches     = $numMatches * 100;
                $newPlGenres    = $numPlGenres * 100;

                if($numPlGenres > $numBaGenres)    //check for difference   if statement A
                {
                    // echo "REACHED IF STATEMENT A <br>";
                    $temp = $numPlGenres  / $numBaGenres;
                    // echo "temp rate = " .$temp."<br>";
                    $newBaGenres = $newBaGenres * $temp;
                    $newMatches = $newMatches * $temp;
                    $newPlGenres = $newPlGenres;
                }
                else if($numBaGenres > $numPlGenres)    //check for difference   if statement B
                {
                    // echo "REACHED IF STATEMENT B <br>";
                    $temp = $numBaGenres / $numPlGenres;
                    // echo "temp rate = " .$temp."<br>";
                    $newPlGenres = $newPlGenres * $temp;
                    $newMatches = $newMatches * $temp;
                    $newBaGenres = $newBaGenres;
                }
                
                //Generate Genre Score
                //$genreScore = $numMatchesResult / (($numPlayerGenres+$numBandGenreResult)-$numMatchesResult);
                // $genreScore = $numMatches / (($numPlGenres+$numBaGenres)-$numMatches);
                $genreScore = ($newMatches / (($newPlGenres+$newBaGenres)-$newMatches))*100;
                // echo "genreScore = ".$newMatches."/((".$newPlGenres."+".$newBaGenres.")-".$newMatches.")";
                // echo "<br>";
                $userArray[$loopValB][4] = $genreScore;
                
                
                
                
                //EchoTest
                // echo "personID: ".$userArray[$loopValB][0];
                // echo '<br>';
                // echo "Username: ".$userArray[$loopValB][3];
                // echo '<br>';
                // echo "newPlGenres:".$newPlGenres;
                // echo '<br>';
                // echo "newMatches:".$newMatches;
                // echo '<br>';
                // echo "newBaGenres:".$newBaGenres;
                // echo '<br>';
                // echo "Calculated genre score: ".$userArray[$loopValB][4];
                // echo '<br>';
                // echo '<br>';
                // echo '<br>';
                // echo '<br>';
                
                $loopValB++;
            }
            
            //Step 5: Put the scores together and sort the users in order of best to worst         
            for ($x = 0; $x < count($userArray); $x++)
            {
                for ($y = $x+1; $y < count($userArray); $y++)
                {
                    if ($userArray[$x][4]<$userArray[$y][4])    //check if the current nested iteration of the array is lesser
                    {
                        for ($z = 0; $z <= 4; $z++)     //move the data into the sorted spot for each user
                        {
                            $temp = $userArray[$y][$z];
                            $userArray[$y][$z] = $userArray[$x][$z];
                            $userArray[$x][$z] = $temp;
                        }
                    }
                }
            }

            for($a = 0; $a < count($userArray); $a++)
            {
                echo "<div>";
                if($a==0)
                {
                    echo "BEST MATCH";
                    echo "<br>";
                }
                else
                {
                    echo "Match No. " . ($a+1);
                    echo "<br>";
                }
                echo $userArray[$a][3];
                echo "<br>";
                echo $userArray[$a][4];
                echo "</div>";
                echo "<br>";
                
            }            
        ?>
    </body>
</html>  