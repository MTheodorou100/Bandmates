<!DOCTYPE html>
<html lang="en">
<title>BandMates | Profiles</title>
<?php require_once('header.php'); ?>

<body>

<?php require_once('nav.php'); ?>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 500px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.h1 {
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

        <!-- <a href="user.php?user=56">go to test user (56)</a> -->
        <!-- <br> -->
        <section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">
        <div class='intro-info' data-aos='zoom-in' data-aos-delay='100'>
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

            // $_SESSION['login_user']

            //echo "you're logged in as: " . $_SESSION['login_user'];

            //echo "<div>";
            //echo "get user = " . $_GET['user'];
            //echo "</div> <br>";

            $thisPersonID = $_GET['user'];

            $sqlUser = "SELECT * FROM Person WHERE personID = '$thisPersonID'";     //get viewed user information
            $resultUser = $conn->query($sqlUser);


            //Get the personID of the user to set as a bandmember
            $currentUsername = $_SESSION['login_user'];
            $sqlPID = "SELECT personID FROM Person WHERE username = '$currentUsername'";
            $resultPID = $conn->query($sqlPID);
            if ($resultPID->num_rows > 0)
            {
                while($row = $resultPID->fetch_assoc())
                {
                    $personID = $row["personID"];
                }
            }
            else
            {
                echo "0 results";
            }
            //Get the user's bands that this profile isn't a part of
            $sqlBands = "SELECT * FROM Band WHERE bandID in (SELECT bandID FROM BandMembers WHERE personID = '$personID') AND NOT bandID in (SELECT bandID FROM BandMembers WHERE personID = '$thisPersonID')";
            $resultBands = $conn->query($sqlBands);



            if ($resultUser->num_rows > 0)
            {
                while($rowA = $resultUser->fetch_assoc())
                {
                    echo "<div class='card bg-primary'>";
                    echo "<div>";
                    //echo "personID = " . $rowA["personID"] . "<br>";
                    echo "<br><h1>Name:  " . $rowA["firstName"] . " " . $rowA["surName"] . "</h1><br>";
                    // echo "genre = " . $rowA["genre"] . "<br>";
                    echo "BIO: " . $rowA["bio"] . "<br>";
                    echo "Experience: " . $rowA["preExp"] . "<br>";
                    echo "Email: " . $rowA["email"] . "<br>";

                    echo "<br> Add this user to one of your bands: <br>";

                    if ($resultBands->num_rows > 0)
                    {
                        echo "<form action=\"addToBand.php\" method=\"post\">";
                        echo "<select name=\"band\" require>";
                        while($rowB = $resultBands->fetch_assoc())
                        {
                            echo "<option value=\"" . $rowB["bandID"] .  "\">" .  $rowB["bandName"] . "</option>";
                        }
                        echo "<input type=\"hidden\" name=\"inviteeID\" value=\"" . $thisPersonID . "\">";
                        echo "</select>";
                        echo "<input type=\"submit\">";
                        echo $rowB["bandID"];
                    }
                    else
                    {
                        echo "0 results - you have no bands that this user isn't a part of";
                    }
                    
                    echo "</div>";
                    echo "<br>";
                }
            }
            else
            {
                echo "0 results - you have no bands that this user isn't a part of";
            }

        ?>
        </div>    
        </section>

        <?php require_once('footer.php'); ?>
    </body>
</html>