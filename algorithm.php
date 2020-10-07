<html>
    <body>
         <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
h1 {
  color: black;
  font-family: verdana;
}
h2 {
  color: black;
  font-family: verdana;
}
p {
  font-family: verdana;
}
          
input {
   font-family: verdana;    
}

form {
   font-family: verdana;   
}
}
</style>
        
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

            //Echo the Results just for Testing
//            echo "<tr>";
//            echo "<th>".$userArray[$loopValA][0]."</th>";
//            echo "<th>".$userArray[$loopValA][1]."</th>";
//            echo "<th>".$userArray[$loopValA][2]."</th>";
//            echo "<th>".$userArray[$loopValA][3]."</th>";
//            echo "</tr>";
//            
            $loopValA++;
            }
     
        //Step 2: Genre score loop (from 0 to 100)
        
        
        
        //Get Number of Band Genres
        $usersListResult = mysqli_query($db, $sqlUsersList) or die(mysqli_error($db));
        $numBandGenres = "SELECT COUNT(genreID) FROM BandGenres WHERE bandID = 21;";
        $numBandGenreResult = mysqli_query($db, $numBandGenres) or die(mysqli_error($db));
        $v3 = mysqli_fetch_array($numBandGenreResult, MYSQL_ASSOC);
        $loopValB=0;

         while ($rowB = mysqli_fetch_array($usersListResult, MYSQL_ASSOC)){
             //Retrieve Number of Player Genres
             $numPlayerGenres = "SELECT COUNT(genreID) FROM LikedGenres WHERE personID = ".$rowB['personID'].";";
             $numPlayerGenresResult = mysqli_query($db, $numPlayerGenres) or die(mysqli_error($db));
             $v1 = mysqli_fetch_array($numPlayerGenresResult, MYSQL_ASSOC);
             
             //Retrieve Number of Matches
             $numMatches = "SELECT COUNT(genreID) FROM BandGenres WHERE genreID IN (SELECT genreID FROM LikedGenres WHERE personID = ".$rowB['personID']." )";
             $numMatchesResult = mysqli_query($db, $numMatches) or die(mysqli_error($db));
             $v2 = mysqli_fetch_array($numMatchesResult, MYSQL_ASSOC);
             
             //Generate Genre Score
             //$genreScore = $numMatchesResult / (($numPlayerGenres+$numBandGenreResult)-$numMatchesResult);
             $genreScore = $v2['COUNT(genreID)'] / (($v1['COUNT(genreID)']+$v3['COUNT(genreID)'])-$v2['COUNT(genreID)']);
             $userArray[$loopValB][4] = $genreScore;
             
             //EchoTest
             echo $userArray[$loopValB][4];
             echo '<br>';
//             echo '<br>';
//             echo $v1['COUNT(genreID)'];
//             echo '<br>';
//             echo $v2['COUNT(genreID)'];
//             echo '<br>';
//             echo $v3['COUNT(genreID)'];
//             
             $loopValB++;
         }
        
        ?>
        </body>
    </html>  