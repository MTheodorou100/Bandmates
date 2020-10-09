<html>
    <body>
        <?php
            session_start();
        
            include("config.php");

            if(isset($_SESSION['login_user']))
            {

                $seshUser = $_SESSION['login_user'];
                $sqlUsersBands = "SELECT * FROM Band WHERE bandID IN (SELECT bandID FROM BandMembers WHERE personID = '$seshUser')";  //select all bands
                $usersBandsResult = mysqli_query($db, $sqlUsersBands) or die(mysqli_error($db));

                echo "
                <div>
                Pick one of your bands to see the best candidates available
                <form action='' method='post'>
                <select name ='selectedBand'>
                ";
                while ($rowC = mysqli_fetch_array($usersBandsResult, MYSQL_ASSOC))
                {
                    echo "<option value='" . $rowC['bandName'] . "'>" . $rowC['bandName'] . "</option>";
                }
                echo "
                </select>
                </form>
                </div>";



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
                    $userArray[$loopValA][4] = 0;
                    $userArray[$loopValA][5] = $row['lastLoginTime'];
                    $userArray[$loopValA][6] = date_diff(date_create($row['dateOfBirth']), date_create('today'))->y;;   //age of user in years
                    $userArray[$loopValA][7] = 0;
                    $userArray[$loopValA][8] = 0;
                    $userArray[$loopValA][9] = 0;
                    $userArray[$loopValA][10] = 0;
                    $loopValA++;
                }
                //^ User Array Key:
                //$userArray[][0] = PersonID
                //$userArray[][1] = First Name
                //$userArray[][2] = SurName
                //$userArray[][3] = User Name
                //$userArray[][4] = Total Score   
                //$userArray[][5] = time of last login
                //$userArray[][6] = age of user in years
                //$userArray[][7] = difference in age of user in the array and the viewer
                //8 = genreScore
                //9 = recencyScore
                //10 = ageScore

            
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

                    $newBaGenres    = $numBaGenres * 100;       //multiply by 100
                    $newMatches     = $numMatches * 100;
                    $newPlGenres    = $numPlGenres * 100;

                    if($numPlGenres > $numBaGenres)    //check for difference   if statement A
                    {
                        $temp = $numPlGenres  / $numBaGenres;
                        $newBaGenres = $newBaGenres * $temp;
                        $newMatches = $newMatches * $temp;
                        $newPlGenres = $newPlGenres;
                    }
                    else if($numBaGenres > $numPlGenres)    //check for difference   if statement B
                    {
                        $temp = $numBaGenres / $numPlGenres;
                        $newPlGenres = $newPlGenres * $temp;
                        $newMatches = $newMatches * $temp;
                        $newBaGenres = $newBaGenres;
                    }
                    
                    $genreScore = ($newMatches / (($newPlGenres+$newBaGenres)-$newMatches))*100;

                    // $userArray[$loopValB][4] = $genreScore;     //put genrescore in the userArray
                    $userArray[$loopValB][8] = $genreScore;
                    
                    $loopValB++;
                }
                

    //Step 3: get login scores (based off recency of last login)

                $fraction = 100/(count($userArray)-1);
                for ($x = 0; $x < count($userArray); $x++)              //sort userArray by most recent date 
                {
                    for ($y = $x+1; $y < count($userArray); $y++)
                    {
                        if ($userArray[$x][5]<$userArray[$y][5])
                        {
                            for ($z = 0; $z <= 4; $z++)     //move the data into the sorted spot for each user
                            {
                                $temp = $userArray[$y][$z];
                                $userArray[$y][$z] = $userArray[$x][$z];
                                $userArray[$x][$z] = $temp;
                            }
                        }
                    }
                    $loginScore = (0 - ($fraction*$x)) + 100;
                    // $userArray[$x][4] += $loginScore;        //add login recency score to the total score
                    $userArray[$x][9] = $loginScore;
                }


    //Step 4: get age scores (based off how close the age of the matches are to the viewer)

                $viewerAge = 25;

                for ($x = 0; $x < count($userArray); $x++)  //get differences between userArray ages and viewerAge
                {
                    if ($viewerAge > $userArray[$x][6])
                    {
                        $ageDifference = $viewerAge - $userArray[$x][6];
                    }
                    else if ($viewerAge < $userArray[$x][6])
                    {
                        $ageDifference = $userArray[$x][6] - $viewerAge;
                    }
                    else 
                    {
                        $ageDifference = 0;
                    }
                    $userArray[$x][7] = $ageDifference;
                    // echo "ageDiff = " . $userArray[$x][7] . "<br>";
                }

                //run sorting for age score distribution
                for ($x = 0; $x < count($userArray); $x++)              //sort userArray by closest age
                {
                    for ($y = $x+1; $y < count($userArray); $y++)
                    {
                        if ($userArray[$x][7]<$userArray[$y][7])
                        {
                            for ($z = 0; $z <= 4; $z++)     //move the data into the sorted spot for each user
                            {
                                $temp = $userArray[$y][$z];
                                $userArray[$y][$z] = $userArray[$x][$z];
                                $userArray[$x][$z] = $temp;
                            }
                        }
                    }
                    $ageScore = (0 - ($fraction*$x)) + 100;
                    // $userArray[$x][4] += $ageScore;      //add ageScore to the total score
                    $userArray[$x][10] = $ageScore;
                }


    //Step 5: Put the scores together and sort the users in order of best match to worst         

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
                    $gScore = $userArray[$a][8];
                    $lScore = $userArray[$a][9];
                    $aScore = $userArray[$a][10];
                    $tScore = $gScore + $lScore + $aScore;

                    echo $userArray[$a][0];
                    echo "<br>";
                    echo $userArray[$a][3];
                    echo "<br>";
                    echo "GenreScore: " . $userArray[$a][8];
                    echo "<br>";
                    echo "LoginScore: " . $userArray[$a][9];
                    echo "<br>";
                    echo "AgeScore: " . $userArray[$a][10];
                    echo "<br>";
                    echo "Total score: " . $tScore;
                    echo "</div>";
                    echo "<br>";
                }          
            }  
            else        //if not logged in (session username not set)
            {
                echo "You must be logged in to see user matches for your band!";
            }
        ?>
    </body>
</html>  