<!DOCTYPE html>
<?php require_once('header.php'); ?>
<?php require_once('nav.php'); ?>
<body>
<section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">
    <style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.h1 {band
  color: white;
}

.title {
  color: grey;
  font-size: 18px;
}


.button {
  background-color: #050514;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>

      
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


            $thisBandID = $_GET['band'];
            $viewerRole = 0;        //viewerRole 0=nonMember, 1=member, 2=leader          

            //leader checking
            if($resultLeaderCheck->num_rows>0)
            {
                while($rowD = $resultLeaderCheck->fetch_assoc())
                {
                    $leaderBoolCheck = $rowD['leaderBool'];
                    $leaderID = $rowD['personID'];
                    if($leaderBoolCheck == 1)
                    {
                       
                        $viewerRole = 2;
                    }
                    else
                    {
                       
                        $viewerRole = 1;
                    }
                }
            }
            //end leader checking
            
            //bandmember deleting
            $sqlBandEditing = "SELECT * FROM Person WHERE personID in (SELECT personID FROM BandMembers WHERE bandID = '$thisBandID' AND personID != '$leaderID')";      //get band members except leader
            $resultBandEditing = $conn->query($sqlBandEditing);
   
            if (isset($_POST['memberArray']))
            {
                $postArray = $_POST['memberArray'];
                // echo(array_values($postArray));
                $postArrayCount = count($postArray);
                echo "<br> postArrayCount = ". $postArrayCount ."<br>";
                for($loopVar = 0; $loopVar < $postArrayCount; $loopVar++)
                {
                    $loopPersonID = $postArray[$loopVar];
                    echo "<br> deleting value... ". $loopPersonID ."<br>";
                    $sqlBandDelete = "DELETE FROM BandMembers WHERE bandID = '$thisBandID' AND personID = '$loopPersonID'";
                    // $sqlBandDelete = "DELETE FROM bandMembers WHERE bandID = 17 AND personID = 138";
                    // $bandDeleteExecute = mysqli_query($conn, $sqlBandDelete);
                    $deleteCheck = $conn->query($sqlBandDelete);
                    // if ($deleteCheck === TRUE) 
                    if ($conn->query($sqlBandDelete) === TRUE) 
                    {
                        echo "Record deleted successfully. <br><br>";
                    } 
                    else 
                    {
                        echo "Error deleting record. <br><br>";
                    }
                
                }
            }
            //end bandmember deleting

            //band info editing
            if ( ( isset($_POST['bandName'] ) ) )
            {
                $rBandName = $_POST['bandName'];
                $sqlReplaceBandName = "UPDATE Band SET bandName = '$rBandName' WHERE bandID = '$thisBandID'";
                if ($conn->query($sqlReplaceBandName) === TRUE) 
                {
                    // echo "(BandName changed successfully)";
                } 
                else 
                {
                    // echo "(bandName wasnt changed)";
                }
            }
            else
            {
                // echo "(bandName wasnt changed)";
            }

            if ( ( isset($_POST['jamBool'] ) ) )
            {
                $rJamBool = $_POST['jamBool'];
                $sqlReplaceJamBool = "UPDATE Band SET bandJamBool = '$rJamBool' WHERE bandID = '$thisBandID'";
                if ($conn->query($sqlReplaceJamBool) === TRUE) 
                {
                    // echo "(jamBool changed successfully)";
                } 
                else 
                {
                    // echo "(jamBool wasnt changed)";
                }
            }
            else
            {
                // echo "(jamBool wasnt changed)";
            }

            if ( ( isset($_POST['feedBool'] ) ) )
            {
                $rFeedBool = $_POST['feedBool'];
                $sqlReplaceFeedBool = "UPDATE Band SET bandShowInFeedBool = '$rFeedBool' WHERE bandID = '$thisBandID'";
                if ($conn->query($sqlReplaceFeedBool) === TRUE) 
                {
                    // echo "(feedBool changed successfully)";
                } 
                else 
                {
                    // echo "(feedBool wasnt changed)";
                }
            }
            else
            {
                // echo "(feedBool wasnt changed)";
            }
            //end band info editing 

            //update bandEditing after deletion
            $resultBandEditing = $conn->query($sqlBandEditing);

            //genre adding
            if (isset($_POST['genreArrayA']))
            {
                $postGenreArray = $_POST['genreArrayA'];
                $postGenreArrayCount = count($postGenreArray);
                for($loopVar = 0; $loopVar < $postGenreArrayCount; $loopVar++)
                {
                    $loopGenreID = $postGenreArray[$loopVar];
                    $sqlGenreAdd = "INSERT INTO BandGenres (bandID, genreID) VALUES ('$thisBandID','$loopGenreID') ";
                    $genreAdd = $conn->query($sqlGenreAdd);
                    // if ($conn->query($sqlGenreAdd) === TRUE) 
                    // {
                    //     echo "Genre(s) added successfully. <br><br>";
                    // } 
                    // else 
                    // {
                    //     echo "Error adding genre(s). <br><br>";
                    // }
                
                }
            }
            else
            {
                // echo "(genreArray not posted)";
            }
            //end genre adding
            //genre deleting
            if (isset($_POST['genreArrayB']))
            {
                $postGenreArrayB = $_POST['genreArrayB'];
                $postGenreArrayBCount = count($postGenreArrayB);
                // echo "<br> postGenreArrayCount = ". $postGenreArrayBCount ."<br>";
                for($loopVar = 0; $loopVar < $postGenreArrayBCount; $loopVar++)
                {
                    $loopGenreID = $postGenreArrayB[$loopVar];
                    // echo "<br> deleting value... ". $loopPersonID ."<br>";
                    $sqlGenreAddB = "DELETE FROM BandGenres WHERE bandID = '$thisBandID' AND genreID = '$loopGenreID' ";
                    $genreDelete = $conn->query($sqlGenreAddB);
                    // if ($conn->query($sqlGenreAddB) === TRUE) 
                    // {
                    //     echo "Genre(s) deleted successfully. <br><br>";
                    // } 
                    // else 
                    // {
                    //     echo "Error deleted genre(s). <br><br>";
                    // }
                
                }
            }
            //end genre deleting



            //instrument adding
            if (isset($_POST['instrumentArrayA']))
            {
                $postInstrumentArrayA = $_POST['instrumentArrayA'];
                $postInstrumentArrayACount = count($postInstrumentArrayA);
                for($loopVar = 0; $loopVar < $postInstrumentArrayACount; $loopVar++)
                {
                    $loopInstrumentID = $postInstrumentArrayA[$loopVar];
                    $sqlInstrumentAdd = "INSERT INTO BandWants (bandID, instrumentID) VALUES ('$thisBandID','$loopInstrumentID') ";
                    $instrumentAdd = $conn->query($sqlInstrumentAdd);                
                }
            }
            else
            {
                // echo "(instrumentArrayA not posted)";
            }
            //end instrument adding
            //instrument deleting
            if (isset($_POST['instrumentArrayB']))
            {
                $postInstrumentArrayB = $_POST['instrumentArrayB'];
                $postInstrumentArrayBCount = count($postInstrumentArrayB);
                for($loopVar = 0; $loopVar < $postInstrumentArrayBCount; $loopVar++)
                {
                    $loopInstrumentID = $postInstrumentArrayB[$loopVar];
                    $sqlInstrumentDelete = "DELETE FROM BandWants WHERE bandID = '$thisBandID' AND instrumentID = '$loopInstrumentID' ";
                    $genreDelete = $conn->query($sqlInstrumentDelete);
                }
            }
            //end instrument deleting

            if ($row["bandJamBool"]== 0) {
                $jam = yes;
            } else {
                $jam = no;
            }




            $sqlBand = "SELECT * FROM Band WHERE bandID = '$thisBandID'";   //get band info
            $resultBand = $conn->query($sqlBand);

            $sqlBandMembers = "SELECT * FROM Person WHERE personID in (SELECT personID FROM BandMembers WHERE bandID = '$thisBandID')";      //get band members
            $resultBandMembers = $conn->query($sqlBandMembers);

            if ($resultBand->num_rows > 0)
            {
                while($row = $resultBand->fetch_assoc())
                {
                    echo "
                     <center><h2 class='white'>Band Profile</h2><br></center> 
                      <div class='card bg-primary'>";
                      echo " <h1>" . $row["bandName"] . "</h1>";
                    // echo "bandGenre = " . $row["bandGenre"] . "<br>";
                    echo "Jam Band: " . $jam . "<br>";
                    if ($resultBandMembers->num_rows > 0)
                {
                    echo "<br> Band Members: <br>";
                    while($rowB = $resultBandMembers->fetch_assoc())
                    {
                        // echo $rowB["firstName"] . "<br>";
                        echo "<a href='viewProfile.php?user=" . $rowB["personID"] . "'>" . $rowB["firstName"] . " " . $rowB["surName"] . "</a> <br>"; //need to set a session id to veiw the profile
                    }
                }
                else
                {
                    echo "no results, there must be 0 band members";
                }
                }

                    // echo "Are you the leader? MUST BE FIXED " . $row["bandJamBool"] . "<br>";
                    echo "</div>";
                    $bandName = $row["bandName"];
                    $jamBool = $row["bandJamBool"];
                    $feedBool = $row["bandShowInFeedBool"];
                    
                echo "<div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";


                //edit if leader
                if($viewerRole == 2)    //viewerRole 0=nonMember, 1=member, 2=leader
                {

                    echo "<div>";
                    echo "get band = " . $_GET['band'];
                    echo "</div> <br>";
                    $seshUser = $_SESSION['login_user'];
            echo "seshUser = " . $seshUser;
            $sqlLeaderCheck = "SELECT * FROM BandMembers WHERE personID in (SELECT personID FROM Person WHERE username = '$seshUser') AND bandID = '$thisBandID'";
            $resultLeaderCheck = $conn->query($sqlLeaderCheck);


                    echo "<br>";
                    echo "<br>";
                    echo "<br>";
                    echo "<div>";
                    echo "You're the leader, here's the editing interface:";
                    echo "<br>";
                    echo "(Leave as is if you don't to change the information)";
                    echo "<br>";
                    echo "Edit Band Details:";
                    echo "<br>";
                    echo "<form action=\"\" method=\"post\">";

                    //input for editing bandName
                    echo "<label for=\"bandName\">bandName: </label> <br>";
                    echo " ";
                    // echo "<input type=\"text\"  id=\"bandName\"     name=\"bandName\"   placeholder=\"" . $bandName . "\">";
                    echo "<input type=\"text\"  id=\"bandName\"     name=\"bandName\"   placeholder=\"" . $bandName . "\"   value=\"" . $bandName . "\">";
                    echo "<br>";

                    //input for editing jam band bool
                    echo "<label for=\"jamBool\">jamBool: </label> <br>";
                    echo "<input type=\"text\"  id=\"jamBool\"      name=\"jamBool\"    placeholder=\"" . $jamBool . "\"    value=\"" . $jamBool . "\">";
                    echo "<br>";
                    
                    //input for editing show in feed bool
                    echo "<label for=\"feedBool\">feedBool: </label> <br>";
                    echo "<input type=\"text\"  id=\"feedBool\"     name=\"feedBool\"   placeholder=\"" . $feedBool . "\"   value=\"" . $feedBool . "\">";
                    echo "<br>";


                    if ($resultBandEditing->num_rows > 0)
                    {
                        echo "Kick Bandmembers:";
                        echo "<br>";
                        while ($rowE = $resultBandEditing->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"" . $rowE["personID"] . "\" name=\"memberArray[]\" value=\"" . $rowE["personID"] . "\">";
                            echo "<label for=\"" . $rowE["personID"] ."\"> " . $rowE["username"] . "(" . $rowE["firstName"] . " " . $rowE["surName"] . ")</label> <br>";
                        }
                    }
                    else
                    {
                        echo "you are the only person in this band, there are no one to kick from the band.";
                    }


                    echo "<br> Add and remove genres: <br>";
                    echo "<div>";

                    $sqlGenres = "SELECT * FROM Genres WHERE genreID NOT IN (SELECT genreID FROM BandGenres WHERE bandID = '$thisBandID')";
				    $resultGenres = $conn->query($sqlGenres);
                    if ($resultGenres->num_rows > 0)
                    {
                        echo "<br>Add Genres:<br>";
                        while($rowC = $resultGenres->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"g" . $rowC["genreID"] . "\" name=\"genreArrayA[]\" value=\"" . $rowC["genreID"] . "\">";
                            echo " ";
                            echo "<label for=\"g" . $rowC["genreID"] ."\"> " . $rowC["genreName"] . "</label> <br>";
                        }
                    }
                    $sqlGenresB = "SELECT * FROM Genres WHERE genreID IN (SELECT genreID FROM BandGenres WHERE bandID = '$thisBandID')";
				    $resultGenresB = $conn->query($sqlGenresB);
                    if ($resultGenresB->num_rows > 0)
                    {
                        echo "<br>Remove Your Genres:<br>";
                        while($rowF = $resultGenresB->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"g" . $rowF["genreID"] . "\" name=\"genreArrayB[]\" value=\"" . $rowF["genreID"] . "\">";
                            echo " ";
                            echo "<label for=\"g" . $rowF["genreID"] ."\"> " . $rowF["genreName"] . "</label> <br>";
                        }
                    }
                    echo "</div>";

                    echo "<br> Add and remove instruments/roles your band wants: <br>";
                    echo "<div>";
                    $sqlInstrumentsA = "SELECT * FROM Instruments WHERE instrumentID NOT IN (SELECT instrumentID FROM BandWants WHERE bandID = '$thisBandID')";
				    $resultInstrumentsA = $conn->query($sqlInstrumentsA);
                    if ($resultInstrumentsA->num_rows > 0)
                    {
                        echo "<br>Add instruments/roles:<br>";
                        while($rowG = $resultInstrumentsA->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"i" . $rowG["instrumentID"] . "\" name=\"instrumentArrayA[]\" value=\"" . $rowG["instrumentID"] . "\">";
                            echo " ";
                            echo "<label for=\"i" . $rowG["instrumentID"] ."\"> " . $rowG["instrumentName"] . "</label> <br>";
                        }
                    }
                    $sqlInstrumentsB = "SELECT * FROM Instruments WHERE instrumentID IN (SELECT instrumentID FROM BandWants WHERE bandID = '$thisBandID')";
				    $resultInstrumentsB = $conn->query($sqlInstrumentsB);
                    if ($resultInstrumentsB->num_rows > 0)
                    {
                        echo "<br>Remove instruments/roles:<br>";
                        while($rowH = $resultInstrumentsB->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"i" . $rowH["instrumentID"] . "\" name=\"instrumentArrayB[]\" value=\"" . $rowH["instrumentID"] . "\">";
                            echo " ";
                            echo "<label for=\"i" . $rowH["instrumentID"] ."\"> " . $rowH["instrumentName"] . "</label> <br>";
                        }
                    }
                    echo "</div>";
                    echo "<br>";
                    echo "<input type=\"submit\">";
                    echo "</form>";


                    echo "</div>";
                }
                else
                {

                }
            }
            else
            {
                echo "0 results";
            }

        ?>
    </div>
    </div>
  </section><!-- End Intro Section -->

  <main id="main">
  <?php require_once('footer.php'); ?>
    </body>
</html>