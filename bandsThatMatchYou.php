<html>
<title>BandMates | Band Feed</title>
<?php require_once('header.php'); ?>

<body>

<?php require_once('nav.php'); ?>  
<section id="intro" class="clearfix">
    <div class="container"> 

        <?php
            session_start();
        
            include("config.php");

            if(isset($_SESSION['login_user']))
            {
                $seshUser = $_SESSION['login_user'];
                echo "<h1>These are the most compatible Bands for you </h1>";
                echo "<br> <br>";

                $sqlUserInfo = "SELECT * FROM Person WHERE username = '$seshUser'";
                $userInfoResult = mysqli_query($db, $sqlUserInfo) or die(mysqli_error($db));
                while ($rowD = mysqli_fetch_array($userInfoResult, MYSQL_ASSOC))
                {
                    $personID = $rowD['personID'];
                    $viewerAge = date_diff(date_create($rowD['dateOfBirth']), date_create('today'))->y;;
                }                   

                    //Step 1: Get all bands that play any instruments the viewer plays
                    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

                    $sqlBandList = "SELECT * FROM Band WHERE bandID IN (SELECT bandID FROM BandWants WHERE instrumentID IN (SELECT instrumentID FROM Plays WHERE personID = $personID) AND NOT bandID IN (SELECT bandID FROM BandMembers WHERE personID = $personID)) AND bandShowInFeedBool = 1;";
                    $bandListResult = mysqli_query($db, $sqlBandList) or die(mysqli_error($db));
                    $bandArray;
                    
                    $loopValA = 0;
                    while ($row = mysqli_fetch_array($bandListResult, MYSQL_ASSOC))
                    {
                        $bandArray[$loopValA][0] = $row['bandID'];
                        $bandArray[$loopValA][1] = $row['bandName'];
                        $bandArray[$loopValA][2] = $row['bandJamBool'];
                        $bandArray[$loopValA][3] = 0;   //genre score
                        $bandArray[$loopValA][4] = 0;   //login score
                        $bandArray[$loopValA][5] = 0;   //age score
                        $bandArray[$loopValA][6] = 0;   //total score
                        
                        $bandIDTemp = $row['bandID'];
                        $sqlBandLeaderID = "SELECT * FROM Person WHERE personID IN (SELECT personID FROM BandMembers WHERE bandID = '$bandIDTemp' AND leaderBool = 1)";     //getting the leader of the band's ID
                        $bandLeaderResult = mysqli_query($db, $sqlBandLeaderID) or die(mysqli_error($db));
                        while ($rowC = mysqli_fetch_array($bandLeaderResult, MYSQL_ASSOC))
                        {
                            $bandArray[$loopValA][7] = $rowC['personID'];
                            $bandArray[$loopValA][8] = date_diff(date_create($rowC['dateOfBirth']), date_create('today'))->y;;
                            $bandArray[$loopValA][9] = $rowC['lastLoginTime'];
                        }
                        $bandArray[$loopValA][10] = 0;

                        // echo $loopValA;
                        // echo "<br>";
                        // echo "[".$loopValA."][". 0 ."] = " . $bandArray[$loopValA][0] . "<br>";
                        // echo "[".$loopValA."][". 1 ."] = " . $bandArray[$loopValA][1] . "<br>";
                        // echo "[".$loopValA."][". 2 ."] = " . $bandArray[$loopValA][2] . "<br>";
                        // echo "[".$loopValA."][". 3 ."] = " . $bandArray[$loopValA][3] . "<br>";
                        // echo "[".$loopValA."][". 4 ."] = " . $bandArray[$loopValA][4] . "<br>";
                        // echo "[".$loopValA."][". 5 ."] = " . $bandArray[$loopValA][5] . "<br>";
                        // echo "[".$loopValA."][". 6 ."] = " . $bandArray[$loopValA][6] . "<br>";
                        // echo "[".$loopValA."][". 7 ."] = " . $bandArray[$loopValA][7] . "<br>";
                        // echo "[".$loopValA."][". 8 ."] = " . $bandArray[$loopValA][8] . "<br>";
                        // echo "[".$loopValA."][". 9 ."] = " . $bandArray[$loopValA][9] . "<br>";
                        // echo "[".$loopValA."][". 10 ."] = " . $bandArray[$loopValA][10] . "<br><br>";


                        $loopValA++;
                    }
                    if ($loopValA==0)
                    {
                        echo "<br>";
                        echo "Oh no! Looks like there's no candidates...";
                    }
                    //^ Band Array Key:
                    //$bandArray[][0] = bandID
                    //$bandArray[][1] = band name
                    //$bandArray[][2] = band jam boolean value

                    //$bandArray[][3] = genre score
                    //$bandArray[][4] = login score   
                    //$bandArray[][5] = age score
                    //$bandArray[][6] = total score

                    //$bandArray[][7] = band leader ID
                    //$bandArray[][8] = band leader's age in years
                    //$bandArray[][9] = band leader's lastLoginTime
                    //$bandArray[][10] = age difference between viewer and band leader

                    // var_dump($bandArray);
                    
                    //Step 2: Genre score loop (from 0 to 100)
                    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

                    $usersListResult = mysqli_query($db, $sqlBandList) or die(mysqli_error($db));
                    
                    //Retrieve Number of Player Genres
                    $numPlayerGenres = "SELECT COUNT(genreID) FROM LikedGenres WHERE personID = ".$personID.";";
                    $numPlayerGenresResult = mysqli_query($db, $numPlayerGenres) or die(mysqli_error($db));
                    $v1 = mysqli_fetch_array($numPlayerGenresResult, MYSQL_ASSOC);
                    $numPlGenres = $v1['COUNT(genreID)'];

                    // echo "<br><br>";
                    // echo "numPlGenres = " . $numPlGenres;

                    $loopValB=0;
                    while ($rowB = mysqli_fetch_array($usersListResult, MYSQL_ASSOC))
                    {
                        //Retrieve Number of Band Genres
                        $numBandGenres = "SELECT COUNT(genreID) FROM BandGenres WHERE bandID = " . $rowB['bandID'];
                        $numBandGenreResult = mysqli_query($db, $numBandGenres) or die(mysqli_error($db));
                        $v3 = mysqli_fetch_array($numBandGenreResult, MYSQL_ASSOC);
                        $numBaGenres = $v3['COUNT(genreID)'];

                        // echo "<br><br>";
                        // echo "numBaGenres = " . $numBaGenres;
                        
                        //Retrieve Number of Matches
                        $numMatches = "SELECT COUNT(genreID) FROM BandGenres WHERE genreID IN (SELECT genreID FROM LikedGenres WHERE personID = ".$personID." ) AND bandID = " . $rowB['bandID'];
                        $numMatchesResult = mysqli_query($db, $numMatches) or die(mysqli_error($db));
                        $v2 = mysqli_fetch_array($numMatchesResult, MYSQL_ASSOC);
                        $numMatches = $v2['COUNT(genreID)'];

                        // echo "<br><br>";
                        // echo "numMatches = " . $numMatches;

                        $newBaGenres    = $numBaGenres * 100;       //multiply by 100
                        $newMatches     = $numMatches * 100;
                        $newPlGenres    = $numPlGenres * 100;

                        if($numPlGenres > $numBaGenres AND $numBaGenres>0)    //check for difference AND make sure not dividing by zero
                        {
                            $temp = $numPlGenres  / $numBaGenres;
                            $newBaGenres = $newBaGenres * $temp;
                            $newMatches = $newMatches * $temp;
                            $newPlGenres = $newPlGenres;
                        }
                        else if($numBaGenres > $numPlGenres AND $numPlGenres>0)    //check for difference AND make sure not dividing by zero
                        {
                            $temp = $numBaGenres / $numPlGenres;
                            $newPlGenres = $newPlGenres * $temp;
                            $newMatches = $newMatches * $temp;
                            $newBaGenres = $newBaGenres;
                        }
                        
                        $genreScore = ($newMatches / (($newPlGenres+$newBaGenres)-$newMatches))*100;

                        $bandArray[$loopValB][3] = $genreScore;
                        
                        $loopValB++;
                    }
                    

                //Step 3: get login scores (based off recency of last login)
                //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

                if ($loopValA>0)
                {
                    if ($loopValA==1)
                    { 
                        $fraction = 100/(count($bandArray));
                    } 
                    else 
                    {
                        $fraction = 100/(count($bandArray)-1);
                    }
                    for ($x = 0; $x < count($bandArray); $x++)              //sort bandArray by most recent date 
                    {
                        for ($y = $x+1; $y < count($bandArray); $y++)
                        {
                            if ($bandArray[$x][9]<$bandArray[$y][9])
                            {
                                for ($z = 0; $z <= 10; $z++)     //move the data into the sorted spot for each user
                                {
                                    $temp = $bandArray[$y][$z];
                                    $bandArray[$y][$z] = $bandArray[$x][$z];
                                    $bandArray[$x][$z] = $temp;
                                }
                            }
                        }
                        $loginScore = (0 - ($fraction*$x)) + 100;

                        $bandArray[$x][4] = $loginScore;
                    }
                }


                    //Step 4: get age scores (based off how close the age of the matches are to the viewer)
                    //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

                    // $viewerAge = 25;     //commented out as it is now set via sql and session

                    if ($loopValA>0)
                    {
                        for ($x = 0; $x < count($bandArray); $x++)  //get differences between bandArray ages and viewerAge
                        {
                            if ($viewerAge > $bandArray[$x][8])
                            {
                                $ageDifference = $viewerAge - $bandArray[$x][8];
                            }
                            else if ($viewerAge < $bandArray[$x][8])
                            {
                                $ageDifference = $bandArray[$x][8] - $viewerAge;
                            }
                            else 
                            {
                                $ageDifference = 0;
                            }
                            $bandArray[$x][10] = $ageDifference;
                        }
                    }
                    if ($loopValA>0)
                    {
                        //run sorting for age score distribution
                        for ($x = 0; $x < count($bandArray); $x++)              //sort bandArray by closest age
                        {
                            for ($y = $x+1; $y < count($bandArray); $y++)
                            {
                                if ($bandArray[$x][10]<$bandArray[$y][10])
                                {
                                    for ($z = 0; $z <= 10; $z++)     //move the data into the sorted spot for each user
                                    {
                                        $temp = $bandArray[$y][$z];
                                        $bandArray[$y][$z] = $bandArray[$x][$z];
                                        $bandArray[$x][$z] = $temp;
                                    }
                                }
                            }
                            $ageScore = (0 - ($fraction*$x)) + 100;

                            $bandArray[$x][5] = $ageScore;
                        }
                    }


                //Step 5: Put the scores together and sort the users in order of best match to worst
                //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------         

                if ($loopValA>0)
                {
                    for($a = 0; $a < count($bandArray); $a++)
                    {
                        $gScore = $bandArray[$a][3];
                        $lScore = $bandArray[$a][4];
                        $aScore = $bandArray[$a][5];
                        $tScore = $gScore + $lScore + $aScore;
                        $bandArray[$a][6] = $tScore;
                    }    


                    for ($x = 0; $x < count($bandArray); $x++)
                    {
                        for ($y = $x+1; $y < count($bandArray); $y++)
                        {
                            if ($bandArray[$x][6]<$bandArray[$y][6])    //check if the current nested iteration of the array is lesser
                            {
                                for ($z = 0; $z <= 10; $z++)     //move the data into the sorted spot for each user
                                {
                                    $temp = $bandArray[$y][$z];
                                    $bandArray[$y][$z] = $bandArray[$x][$z];
                                    $bandArray[$x][$z] = $temp;
                                }
                            }
                        }
                    }

                    for($a = 0; $a < count($bandArray); $a++)
                    {
                        echo "<div>";
                        if($a==0)
                        {
                            echo "<h3>BEST MATCH:</h3>";
                        }
                        else
                        {
                            echo "<h3>Match No. " . ($a+1) . ":</h3>";
                        }
                        echo "<div class='card text-white bg-primary mb-3' style='max-width: 24rem'>";
                        echo "<br><h5>Band name: " . $bandArray[$a][1]; "</h5>";
                        echo "<br><br>";
                        echo "<a class='btn btn-success' href=\"band.php?band=" . $bandArray[$a][0] . "\" role='button'>View Band Profile</a> ";
                        echo "</div></div>";
                        echo "<br><br>";
                    }    
                }
            }
              
            else        //if not logged in (session username not set)
            {
                echo "You must be logged in to see user matches for your band!";
            }

                
        ?>

          </div>    
        </section>
        <?php require_once('footer.php'); ?>

    </body>
</html>  