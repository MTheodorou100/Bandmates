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
            $viewerRole = 0;        //viewerRole 0=nonMember, 1=member, 2=leader          

            //leader checking
            $seshUser = $_SESSION['login_user'];
            echo "seshUser = " . $seshUser;
            $sqlLeaderCheck = "SELECT * FROM BandMembers WHERE personID in (SELECT personID FROM Person WHERE username = '$seshUser') AND bandID = '$thisBandID'";
            $resultLeaderCheck = $conn->query($sqlLeaderCheck);

            if($resultLeaderCheck->num_rows>0)
            {
                while($rowD = $resultLeaderCheck->fetch_assoc())
                {
                    $leaderBoolCheck = $rowD['leaderBool'];
                    $leaderID = $rowD['personID'];
                    if($leaderBoolCheck == 1)
                    {
                        echo "this user is a leader";
                        $viewerRole = 2;
                    }
                    else
                    {
                        echo "loser, not a leader";
                        $viewerRole = 1;
                    }
                }
            }
            else
            {
                echo "<br>";
                echo "you're not a member of this band";
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

            $sqlBand = "SELECT * FROM Band WHERE bandID = '$thisBandID'";   //get band info
            $resultBand = $conn->query($sqlBand);

            $sqlBandMembers = "SELECT * FROM Person WHERE personID in (SELECT personID FROM BandMembers WHERE bandID = '$thisBandID')";      //get band members
            $resultBandMembers = $conn->query($sqlBandMembers);

            if ($resultBand->num_rows > 0)
            {
                while($row = $resultBand->fetch_assoc())
                {
                    echo "<div>";
                    echo "Band Details: <br>";
                    echo "bandID = " . $row["bandID"] . "<br>";
                    echo "bandName = " . $row["bandName"] . "<br>";
                    // echo "bandGenre = " . $row["bandGenre"] . "<br>";
                    echo "Jam Band? " . $row["bandJamBool"] . "<br>";
                    echo "Showing in people's feeds? " . $row["bandShowInFeedBool"] . "<br>";
                    // echo "Are you the leader? MUST BE FIXED " . $row["bandJamBool"] . "<br>";
                    echo "</div>";
                    $bandName = $row["bandName"];
                    $jamBool = $row["bandJamBool"];
                    $feedBool = $row["bandShowInFeedBool"];
                }
                echo "<div>";
                if ($resultBandMembers->num_rows > 0)
                {
                    echo "Band Members: <br>";
                    while($rowB = $resultBandMembers->fetch_assoc())
                    {
                        echo $rowB["firstName"] . "<br>";
                    }
                }
                else
                {
                    echo "no results, there must be 0 band members";
                }
                echo "</div>";

                // $sqlBandEditing = "SELECT * FROM Person WHERE personID in (SELECT personID FROM BandMembers WHERE bandID = '$thisBandID' AND personID != '$leaderID')";      //get band members except leader
                // $resultBandEditing = $conn->query($sqlBandEditing);

                //edit if leader
                if($viewerRole == 2)    //viewerRole 0=nonMember, 1=member, 2=leader
                {
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
                    echo "<label for=\"bandName\">bandName: </label>";
                    // echo "<input type=\"text\"  id=\"bandName\"     name=\"bandName\"   placeholder=\"" . $bandName . "\">";
                    echo "<input type=\"text\"  id=\"bandName\"     name=\"bandName\"   placeholder=\"" . $bandName . "\"   value=\"" . $bandName . "\">";
                    echo "<br>";

                    //input for editing jam band bool
                    echo "<label for=\"jamBool\">jamBool: </label>";
                    echo "<input type=\"text\"  id=\"jamBool\"      name=\"jamBool\"    placeholder=\"" . $jamBool . "\"    value=\"" . $jamBool . "\">";
                    echo "<br>";
                    
                    //input for editing show in feed bool
                    echo "<label for=\"feedBool\">feedBool: </label>";
                    echo "<input type=\"text\"  id=\"feedBool\"     name=\"feedBool\"   placeholder=\"" . $feedBool . "\"   value=\"" . $feedBool . "\">";
                    echo "<br>";


                    if ($resultBandEditing->num_rows > 0)
                    {
                        echo "Kick Bandmembers:";
                        echo "<br>";
                        while ($rowE = $resultBandEditing->fetch_assoc())
                        {
                            // echo "<input type=\"checkbox\" id=\"" . $rowE["personID"] . "\" name=\"" . $rowE["personID"] . "\" value=\"" . $rowE["personID"] . "\">";
                            echo "<input type=\"checkbox\" id=\"" . $rowE["personID"] . "\" name=\"memberArray[]\" value=\"" . $rowE["personID"] . "\">";
                            echo "<label for=\"" . $rowE["personID"] ."\"> " . $rowE["username"] . "(" . $rowE["firstName"] . " " . $rowE["surName"] . ")</label> <br>";
                        }
                    }
                    else
                    {
                        echo "you are the only person in this band, there are no one to kick from the band.";
                    }

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
    </body>
</html>