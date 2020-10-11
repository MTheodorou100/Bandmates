            <?php   
            session_start();    
include("config.php");
if(isset($_POST['submit'])){
$servername = utf8_encode("35.197.167.52");
$dbname = utf8_encode("bandmates");
$username = utf8_encode("root");
$password = utf8_encode("mypassword");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}     

$fname = $_POST['fname'];
$lname= $_POST['lname'];
$username= $_SESSION['login_user'];
   $bio = $_POST['bio'];
   $pexp = $_POST['pexp'];

$sql = "UPDATE Person SET firstName='$_POST[fname]', surName='$_POST[lname]', bio='$_POST[bio]', preExp='$_POST[pexp]', email='$_POST[email]' WHERE username='$_SESSION[login_user]'";
$result = mysqli_query($db, $sql) or die(mysqli_error($db));
    
     $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
      $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
      $querysql = mysqli_fetch_array($usersListResult, MYSQL_ASSOC);
                 
    foreach($_POST['instruments'] as $loopInstrumentID) {
        $sqlInstrumentDelete = "DELETE FROM Plays WHERE personID='$querysql[personID]'AND instrumentID='$loopInstrumentID';";
        $InsDel = mysqli_query($db, $sqlInstrumentDelete) or die(mysqli_error($db));
    }
    
    foreach($_POST['genreArrayA'] as $loopGenreID) {
       //$sqlGenreDelete = "INSERT INTO LikedGenres (personID, genreID) VALUES ('$querysql[personID]','$loopGenreID');";
       $sqlGenreDelete = "DELETE FROM LikedGenres WHERE personID='$querysql[personID]'AND genreID='$loopGenreID';";
        $GenDel = mysqli_query($db, $sqlGenreDelete) or die(mysqli_error($db));
    }
  
  foreach($_POST['instruments2'] as $loopInstrumentID) {
        $sqlInstrumentAdd = "INSERT INTO Plays (personID, instrumentID) VALUES ('$querysql[personID]','$loopInstrumentID');";
        $insertIntoBandWants = mysqli_query($db, $sqlInstrumentAdd) or die(mysqli_error($db));
    }
    
    foreach($_POST['genreArray2'] as $loopGenreID) {
        $sqlGenreAdd = "INSERT INTO LikedGenres (personID, genreID) VALUES ('$querysql[personID]','$loopGenreID');";
        $insertIntoBandWants = mysqli_query($db, $sqlGenreAdd) or die(mysqli_error($db));
    }

   header("location: profile.php");
}

            ?>

<html lang="en">
<title>BandMates | Edit Profile</title>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
  <script type="text/javascript">
      
  function validate()
    {
        var firstname = document.getElementById("fname");
        var lastname = document.getElementById("lname");
        var textarea = document.getElementById("bio");
        var textarea2 = document.getElementById("pexp");
        
        if(firstname.value.trim() =="")
          {  
            //alert("Blank username");
            firstname.style.border = "solid 3px red";
            document.getElementById("lblfname").style.visibility="visible";
            return false;
          }
       else if(lastname.value.trim() =="")
          {
            //alert("Blank password");
            lastname.style.border = "solid 3px red";
            document.getElementById("lbllname").style.visibility="visible";
            return false;  
          }
       else if(textarea.value.trim() =="")
          {
            //alert("Blank password");
            textarea.style.border = "solid 3px red";
            document.getElementById("lbltxtarea").style.visibility="visible";
            return false;  
          }
       else if(textarea2.value.trim() =="")
          {
            //alert("Blank password");
            textarea2.style.border = "solid 3px red";
            document.getElementById("lbltxtarea2").style.visibility="visible";
            return false;
          }
        else
          {
            return true;
          }
    }
      
    function livefnamevalidate()
      {
          var firstname = document.getElementById("fname");
          
          if(firstname.value.trim() != "")
          {
              firstname.style.border = "solid 3px green";
              document.getElementById("lblfname").style.visibility="hidden";
          }
        else
          {
              firstname.style.border = "solid 3px red";
              document.getElementById("lblfname").style.visibility="visible";
          }
    }
    
  function livelnamevalidate()
      {
          var lastname = document.getElementById("lname");
          
          if(lastname.value.trim() != "")
          {
              lastname.style.border = "solid 3px green";
              document.getElementById("lbllname").style.visibility="hidden";
          }
        else
          {
              lastname.style.border = "solid 3px red";
              document.getElementById("lbllname").style.visibility="visible";
          }
      }
          
  function livebiovalidate()
      {
          var textarea = document.getElementById("bio");
          
          if(textarea.value.trim() != "")
          {
              textarea.style.border = "solid 3px green";
              document.getElementById("lbltxtarea").style.visibility="hidden";
          }
        else
          {
              textarea.style.border = "solid 3px red";
              document.getElementById("lbltxtarea").style.visibility="visible";
          }
      }
          
  function livepbevalidate()
      {
          var textarea2 = document.getElementById("pexp");
          
          if(textarea2.value.trim() != "")
          {
              textarea2.style.border = "solid 3px green";
              document.getElementById("lbltxtarea2").style.visibility="hidden";
          }
        else
          {
              textarea2.style.border = "solid 3px red";
              document.getElementById("lbltxtarea2").style.visibility="visible";
          }
    }
      
    </script>

  <title>BandMates | Edit your Profile</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <style>
label {
    color: white;
}

</style>

<?php require_once('header.php'); ?>

<body>

  <!-- ======= Header ======= -->
  <?php require_once('nav.php'); ?>
        

    <section id="intro" class="clearfix">
    <div class="container">
        <h2 class="white">Edit Profile</h2>
        <p class="white">Fill in your details and modify your Profile</p>
   		 <form onsubmit="return validate()" action="" method='POST'>

  <label class="white" for="firstname">First Name:</label>

  <input id="fname" name="fname" type="text" onchange="livefnamevalidate()">
  <label id="lblfname" style="color: red; visibility: hidden;"> Please enter first name</label>
  <br><br>
             
  <label class="white" for="lastname">Last Name:</label>
  <input id="lname" name="lname" type="text" onchange="livelnamevalidate()">
  <label id="lbllname" style="color: red; visibility: hidden;"> Please enter last name</label>
  <br><br>
             
           
        
           
             
             

             
    <div class="bio">
  <label class="white" for="Bio">Bio (Tell us about yourself):</label><br>
    <textarea name="bio" id='bio' rows="4" cols="50" onchange="livebiovalidate()"></textarea>
    <label id="lbltxtarea" style="color: red; visibility: hidden;"> Please enter details in the text box provided</label>
    </div>  
             
    <div class="pexp">
  <label class="white" for="pexp">Write about your previous Band Experiences:</label><br>
    <textarea name="pexp" id='pexp' rows="4" cols="50" onchange="livepbevalidate()"></textarea>
    <label id="lbltxtarea2" style="color: red; visibility: hidden;"> Please enter details in the text box provided</label>
    </div>
             
<div class="email">
  <label class="white" for="email">Contact Email:</label>
  <input type="email" id="email" name="email" class="form-control">
</div>
            <br>   
           <h2 class="white">Modify Instruments</h2>   
           <?php
           $servername = utf8_encode("35.197.167.52");
           $dbname = utf8_encode("bandmates");
           $username = utf8_encode("root");
           $password = utf8_encode("mypassword");
           $conn = new mysqli($servername, $username, $password, $dbname);
           if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
           }     
            $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
            $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
            $querysql = mysqli_fetch_array($usersListResult, MYSQL_ASSOC);
           
            $sqlInstruments = "SELECT * FROM Instruments WHERE instrumentID IN (SELECT instrumentID FROM Plays WHERE personID='$querysql[personID]')";
				$resultInstruments = $conn->query($sqlInstruments);
				if ($resultInstruments->num_rows > 0)
				{
					echo "<div><label> Select Instruments to Remove from your profile:</label> <br>";
					// echo "<form action=\"genreFormTest.php\" method=\"post\">";
					while($rowD = $resultInstruments->fetch_assoc())
					{
            echo "<input type=\"checkbox\" id=\"i" . $rowD["instrumentID"] . "\" name=\"instruments[]\" value=\"" . $rowD["instrumentID"] . "\">";
            echo " ";
						// echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
						echo "<label for=\"i" . $rowD["instrumentID"] ."\"> " . $rowD["instrumentName"] . "</label> <br>";
						// echo $rowC["genreName"] . "<br>";
					}
					// echo "<input type=\"submit\">";
					echo "</div>";
					// echo "</form>";
        }
           
           $sqlInstruments2 = "SELECT * FROM Instruments WHERE instrumentID NOT IN (SELECT instrumentID FROM Plays WHERE personID='$querysql[personID]')";
				$resultInstruments2 = $conn->query($sqlInstruments2);
				if ($resultInstruments->num_rows > 0)
				{
					echo "<div><label> Select Instruments to Add to your profile:</label> <br>";
					// echo "<form action=\"genreFormTest.php\" method=\"post\">";
					while($rowD = $resultInstruments2->fetch_assoc())
					{
            echo "<input type=\"checkbox\" id=\"i" . $rowD["instrumentID"] . "\" name=\"instruments2[]\" value=\"" . $rowD["instrumentID"] . "\">";
            echo " ";
						// echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
						echo "<label for=\"i" . $rowD["instrumentID"] ."\"> " . $rowD["instrumentName"] . "</label> <br>";
						// echo $rowC["genreName"] . "<br>";
					}
					// echo "<input type=\"submit\">";
					echo "</div>";
					// echo "</form>";
        }
    
    
    
                     echo "<div>";
           
           echo "<h2 class=white>Modify Genres</h2>";
                    // $sqlGenres = "SELECT * FROM Genres";
            $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
            $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
           
                    $sqlGenres = "SELECT * FROM Genres WHERE genreID IN (SELECT genreID FROM LikedGenres WHERE personID='$querysql[personID]')";
				    $resultGenres = $conn->query($sqlGenres);
                    if ($resultGenres->num_rows > 0)
                    {
                        echo "<label>Select Genres to Remove from your profile:</label><br>";
                        // echo "<form action=\"genreFormTest.php\" method=\"post\">";
                        while($rowC = $resultGenres->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"g" . $rowC["genreID"] . "\" name=\"genreArrayA[]\" value=\"" . $rowC["genreID"] . "\">";
                            echo " ";
                            // echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
                            echo "<label for=\"g" . $rowC["genreID"] ."\"> " . $rowC["genreName"] . "</label> <br>";
                            // echo $rowC["genreName"] . "<br>";
                        }
                        // echo "<input type=\"submit\">";
                        // echo "</div>";
                        // echo "</form>";
                    }
           
           
            $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
            $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
           
                    $sqlGenres2 = "SELECT * FROM Genres WHERE genreID NOT IN (SELECT genreID FROM LikedGenres WHERE personID='$querysql[personID]')";
				    $resultGenres2 = $conn->query($sqlGenres2);
                    if ($resultGenres2->num_rows > 0)
                    {
                        echo "<label>Select Genres to Add to your profile:</label><br>";
                        // echo "<form action=\"genreFormTest.php\" method=\"post\">";
                        while($rowC = $resultGenres2->fetch_assoc())
                        {
                            echo "<input type=\"checkbox\" id=\"g" . $rowC["genreID"] . "\" name=\"genreArray2[]\" value=\"" . $rowC["genreID"] . "\">";
                            echo " ";
                            // echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"checkbox[]\" value=\"" . $rowC["genreID"] . "\">";
                            echo "<label for=\"g" . $rowC["genreID"] ."\"> " . $rowC["genreName"] . "</label> <br>";
                            // echo $rowC["genreName"] . "<br>";
                        }
                        // echo "<input type=\"submit\">";
                        // echo "</div>";
                        // echo "</form>";
                    }
             
    ?>  
    <br>
             
 <button class="btn btn-success" name="submit" type="submit" href="">Make Changes</button>
         
         </form>
    </div>    
        </section>
</body>
<?php require_once('footer.php'); ?>
</html>