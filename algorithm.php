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
        
        while ($row = mysqli_fetch_array($usersListResult, MYSQL_ASSOC)){
            $userArray[$loopValA][0] = $row['personID'];
            $userArray[$loopValA][1] = $row['firstName'];
            $userArray[$loopValA][2] = $row['surName'];
            $userArray[$loopValA][3] = $row['username'];
      
            $loopValA++;
            }
     
        //Step 2: Genre score loop (from 0 to 100)
        
        
        
        //Get Number of Band Genres
        $usersListResult = mysqli_query($db, $sqlUsersList) or die(mysqli_error($db));
        $numBandGenres = "SELECT COUNT(genreID) FROM BandGenres WHERE bandID = 21;";
        $numBandGenreResult = mysqli_query($db, $numBandGenres) or die(mysqli_error($db));
        $v3 = mysqli_fetch_array($numBandGenreResult, MYSQL_ASSOC);
        $loopValB=0;
        $nBandGenreResult = $v3['COUNT(genreID)'];
         while ($rowB = mysqli_fetch_array($usersListResult, MYSQL_ASSOC)){
             //Retrieve Number of Player Genres
             $numPlayerGenres = "SELECT COUNT(genreID) FROM LikedGenres WHERE personID = ".$rowB['personID'].";";
             $numPlayerGenresResult = mysqli_query($db, $numPlayerGenres) or die(mysqli_error($db));
             $v1 = mysqli_fetch_array($numPlayerGenresResult, MYSQL_ASSOC);
             $nPlayerGenreResult = $v1['COUNT(genreID)'];
             
             //Retrieve Number of Matches
             $numMatches = "SELECT COUNT(genreID) FROM BandGenres WHERE genreID IN (SELECT genreID FROM LikedGenres WHERE personID = ".$rowB['personID']." ) AND bandID = 21";
             $numMatchesResult = mysqli_query($db, $numMatches) or die(mysqli_error($db));
             $v2 = mysqli_fetch_array($numMatchesResult, MYSQL_ASSOC);
             $nMatchesResult = $v2['COUNT(genreID)'];
             
             
             if($nPlayerGenreResult > $nBandGenreResult)    //check for difference
             {
                 $temp = $nPlayerGenreResult  / $nBandGenreResult;
                 $nBandGenreResult = $nBandGenreResult * $temp;
                $nMatchesResult = $nMatchesResult * $temp;
             }
             if($nBandGenreResult > $nPlayerGenreResult)    //check for difference
             {
                 $temp = $nBandGenreResult / $nPlayerGenreResult;
                $nPlayerGenreResult = $nPlayerGenreResult * $temp;
                 $nMatchesResult = $nMatchesResult * $temp;
             }
             
             //Generate Genre Score
             //$genreScore = $numMatchesResult / (($numPlayerGenres+$numBandGenreResult)-$numMatchesResult);
             $genreScore = $nMatchesResult / (($nPlayerGenreResult+$nBandGenreResult)-$nMatchesResult);
             $userArray[$loopValB][4] = $genreScore;
             
             
             
             
             //EchoTest
             echo $userArray[$loopValB][4];
            echo '<br>';
            echo '<br>';
             echo "numPlayerGenresResult:".$nPlayerGenreResult;
            echo '<br>';
          echo "numMatchesResult:".$nMatchesResult;
             echo '<br>';
            echo "numBandGenreResult:".$nBandGenreResult;
            echo '<br>';
             
             $loopValB++;
         }
        
        //Step 5: Put the scores together and sort the users in order of best to worst
        $scoreArray;//1st box is index ie which person, 2nd box is where personID and score is stored (“0” and “1” respectively)
        $scoreloopVal=0;
        $usersListResult = mysqli_query($db, $sqlUsersList) or die(mysqli_error($db));
        
        while ($rowC = mysqli_fetch_array($usersListResult, MYSQL_ASSOC)){
            $scoreArray[$scoreloopVal][0]+= $userArray[$scoreloopVal][4];
            // $scoreArray[$scoreloopVal][0]+= $anotherScoreHere;
            $scoreloopVal++;
        }
        
        
        
        
        
        
        
        
        //User Array Key:
        //$userArray[0][0] = PersonID
        //$userArray[0][1] = First Name
        //$userArray[0][2] = SurName
        //$userArray[0][3] = User Name
        //$userArray[0][4] = Genre Score
        
        
        
        ?>
        </body>
    </html>  