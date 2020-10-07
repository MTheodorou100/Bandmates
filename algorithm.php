<html>
    <body>
    <table>
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
            }?>    
        </table>
        <?php
        //Step 2: Genre score loop (from 0 to 100)
        
        //Get Number of Band Genres
        $numBandGenres = "SELECT COUNT(genreID) FROM BandGenres WHERE bandID = 21;";
        $BandsListResult = mysqli_query($db, $sqlUsersList) or die(mysqli_error($db));
        
        $loopValB=0;
         while ($rowB = mysqli_fetch_array($usersListResult, MYSQL_ASSOC)){
             $numPlayerGenres = "SELECT COUNT(genreID) FROM LikedGenres WHERE personID = ".$rowB['personID'].";";
             $numMatches = "SELECT COUNT(genreID) FROM BandGenres WHERE genreID IN (SELECT genreID FROM LikedGenres WHERE personID = ".$rowB['personID']." )";
             $genreScore = $numMatches / (($numPlayerGenres+$BandsListResult)-$numMatches);
             
             $userArray [$loopValB][4] = $genreScore;
             $loopValB++;
         }
        
        ?>
        
        </body>
    </html>  