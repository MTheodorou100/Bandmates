<!DOCTYPE html>

<title>BandMates | Search</title>
<?php require_once('header.php'); ?>

<body>
<?php require_once('nav.php'); ?>
<section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">
        <?php
            include("config.php");
            session_start();

            //this section gets the database data when the form is posted
            //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if(isset($_POST['searchTerm']) AND isset($_POST['bandOrPeople']))
            {
                $searchTerm = $_POST['searchTerm'];
                $results = 0;

                if($_POST['bandOrPeople']=="band")      //if the viewer searched for a band, the following code gets bands where the name or genres or instruments match the search term
                {
                    $sqlSearchBands = "  SELECT * FROM Band WHERE bandName LIKE '%".$searchTerm."%' 
                                                            OR bandID IN 
                                                            (
                                                                SELECT bandID FROM BandGenres WHERE genreID IN 
                                                                    (
                                                                        SELECT genreID FROM Genres WHERE genreName LIKE '%".$searchTerm."%'
                                                                    )
                                                            )
                                                            OR bandID IN
                                                            (
                                                                SELECT bandID FROM BandWants WHERE instrumentID IN 
                                                                (
                                                                    SELECT instrumentID FROM Instruments WHERE instrumentName LIKE '%".$searchTerm."%'
                                                                )
                                                            )";
                    $searchBandsResult = mysqli_query($db, $sqlSearchBands) or die(mysqli_error($db));

                    $bandArray;
                    $loopVar = 0;
                    while ($row = mysqli_fetch_array($searchBandsResult, MYSQL_ASSOC))
                    {
                        $bandArray[$loopVar][0] = $row['bandID'];
                        $bandArray[$loopVar][1] = $row['bandName'];
                        $bandArray[$loopVar][2] = $row['bandJamBool'];
                        $bandArray[$loopVar][3] = $row['bandShowInFeedBool'];

                        // echo $bandArray[$loopVar][0] . "<br>";       //can be uncommented for debugging
                        // echo $bandArray[$loopVar][1] . "<br>";
                        // echo $bandArray[$loopVar][2] . "<br>";
                        // echo $bandArray[$loopVar][3] . "<br>";

                        $loopVar++;
                        $results = 1;
                    }
                }
                else if($_POST['bandOrPeople']=="people")      //if the viewer searched for a person, the following code gets people where their name or genres or instruments match the search term
                {
                    $sqlSearchPeople = "  SELECT * FROM Person  WHERE username LIKE '%".$searchTerm."%' 
                                                                OR firstName LIKE '%".$searchTerm."%' 
                                                                OR surName LIKE '%".$searchTerm."%'
                                                                OR personID IN 
                                                                (
                                                                    SELECT personID FROM LikedGenres WHERE genreID IN 
                                                                        (
                                                                            SELECT genreID FROM Genres WHERE genreName LIKE '%".$searchTerm."%'
                                                                        )
                                                                )
                                                                OR personID IN
                                                                (
                                                                    SELECT personID FROM Plays WHERE instrumentID IN
                                                                    (
                                                                        SELECT instrumentID FROM Instruments WHERE instrumentName LIKE '%".$searchTerm."%'
                                                                    )
                                                                )";
                    $searchPeopleResult = mysqli_query($db, $sqlSearchPeople) or die(mysqli_error($db));

                    $peopleArray;
                    $loopVar = 0;
                    while ($row = mysqli_fetch_array($searchPeopleResult, MYSQL_ASSOC))
                    {
                        // echo "reached people loop <br>";
                        $peopleArray[$loopVar][0] = $row['personID'];
                        $peopleArray[$loopVar][1] = $row['firstName'];
                        $peopleArray[$loopVar][2] = $row['surName'];
                        $peopleArray[$loopVar][3] = $row['username'];
                        $peopleArray[$loopVar][4] = $row['bio'];
                        $peopleArray[$loopVar][5] = $row['preExp'];
                        $peopleArray[$loopVar][6] = $row['email'];

                        // echo $peopleArray[$loopVar][0] . "<br>";         //can be uncommented for debugging
                        // echo $peopleArray[$loopVar][1] . "<br>";
                        // echo $peopleArray[$loopVar][2] . "<br>";
                        // echo $peopleArray[$loopVar][3] . "<br>";
                        // echo $peopleArray[$loopVar][4] . "<br>";
                        // echo $peopleArray[$loopVar][5] . "<br>";
                        // echo $peopleArray[$loopVar][6] . "<br>";

                        $loopVar++;
                        $results = 1;
                    }
                }
            }

            //this section echoes the form
            //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            echo "<h1> Search for Bands or Musicians </h1>";
            echo "
            <form method='post' action=''> 
                <label for='searchTerm'>Search term:</label>
                <br>";

            if(isset($_POST['searchTerm']))     //checks that the search term was posted
            {
                $searchTerm = $_POST['searchTerm'];
                echo "
                    <input type='text' id='searchTerm' name='searchTerm' value='$searchTerm' required><br>
                ";
            }
            else    //this runs if nothing has been posted to the page, eg when it is first opened
            {
                echo "
                    <input type='text' id='searchTerm' name='searchTerm' placeholder='Your search here...' required>
                ";
            }

            echo "
                <br>
            ";

            if(isset($_POST['bandOrPeople']))           //checks that the radio input was posted
            {
                if($_POST['bandOrPeople']=="people")        //checks that PEOPLE was the radio button selected
                {
                    echo "
                    <input type='radio' id='band' name='bandOrPeople' value='band' required>
                    <label for='band'>Search for bands</label>
                    <br>
                    <input type='radio' id='people' name='bandOrPeople' value='people' checked>
                    <label for='people'>Search for people</label>
                    <br>
                ";
                }
                else if($_POST['bandOrPeople']=="band")         //checks that BAND was the radio button selected
                {
                    echo "
                        <input type='radio' id='band' name='bandOrPeople' value='band' required checked>
                        <label for='band'>Search for bands</label>
                        <br>
                        <input type='radio' id='people' name='bandOrPeople' value='people'>
                        <label for='people'>Search for people</label>
                        <br>
                    ";
                }
            }
            else        //this runs if nothing has been posted to the page, eg when it is first opened
            {
                echo "
                    <input type='radio' id='band' name='bandOrPeople' value='band' required>
                    <label for='band'>Search for bands</label>
                    <br>
                    <input type='radio' id='people' name='bandOrPeople' value='people'>
                    <label for='people'>Search for people</label>
                    <br>
                ";
            }

            echo "
                    <input class='btn btn-success' type='submit'>

                    </form>
                ";
            

            //this section echoes the search results
            //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            if (isset($results))        //runs if something was searched
            {
                echo "<section>";
                if ($results==0)
                {
                    echo "No results for this search...";
                }
                else if ($_POST['bandOrPeople']=="people")
                {
                    
                    for($x = 0; $x < COUNT($peopleArray); $x++)     //loop through people array and display the search results
                    {   
                        echo "<br>";
                        echo "<div class='card bg-primary text-center' style='max-width: 18rem;'>";
                        echo "<br>";
                        echo "Name: " . $peopleArray[$x][1] . " " . $peopleArray[$x][2];
                        echo "<br><br>";
                        echo "<a class='btn btn-success' href='viewProfile.php?user=" . $peopleArray[$x][0] . "' role='button'>View Profile</a>";       //link to the user's page

                        // echo "<br>";
                        echo "</div>";

                        echo "<br>";
                    }
                }
                else if ($_POST['bandOrPeople']=="band")
                {
                    for($x = 0; $x < COUNT($bandArray); $x++)       //loop through band array and display the search results
                    {

                        echo "<br>";
                        echo "<div class='card bg-primary text-center' style='max-width: 18rem;'>";
                        echo "<br>";
                        echo "bandname: " . $bandArray[$x][1];
                        echo "<br><br>";
                        echo "<a class='btn btn-success' href='band.php?band=" . $bandArray[$x][0] . "' role='button'>View Band Profile</a>";       //link to the band page
                        // echo "<br>";
                        echo "</div>";
                        
                        echo "<br>";
                    }
                }
                echo "</section>";
            }
        ?>

       </div>
  </section><!-- End Intro Section -->

  <main id="main">
  <?php require_once('footer.php'); ?>

    </body>
</html>