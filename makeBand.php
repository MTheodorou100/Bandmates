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

	//putting in band into the database
	if( (isset($_POST['bandName']) == true) and (isset($_POST['bandJam']) == true) )      //ensures that the form was sent
	{
		$currentUsername = $_SESSION['login_user'];
		$newBandName = $_POST['bandName'];
		$newBandGenre = $_POST['bandGenre'];
		$newBandJamBool = $_POST['bandJam'];
		$newBandFeedBool = $_POST['feedBool'];

		//Make the band
		$sql1 = "INSERT INTO Band (bandName, bandJamBool, bandShowInFeedBool) VALUES ('$newBandName', '$newBandJamBool', '$newBandFeedBool')";
		if ($conn->query($sql1) === TRUE) //executes "$conn->query($sql);" to run the insert
		{
			$last_id = $conn->insert_id;
		} 
		else 
		{
			// echo "Error: " . $sql1 . "<br>" . $conn->error;
		}

		//Get the personID of the user to set as a bandmember
		$sqlPID = "SELECT personID FROM Person WHERE username = '$currentUsername'";
		$resultPID = $conn->query($sqlPID);
		if ($resultPID->num_rows > 0)
		{
			while($row = $resultPID->fetch_assoc())
			{
				$newBandLeader = $row["personID"];
			}
		}
		else
		{
			// echo "0 results";
		}

		//Make the user a bandmember
		$leaderBoolean = TRUE;
		$sql2 = "INSERT INTO BandMembers (bandID, personID, leaderBool) VALUES ('$last_id', '$newBandLeader', '$leaderBoolean')";
		if ($conn->query($sql2) === TRUE) //executes "$conn->query($sql);" to run the insert
		{
		} 
		else 
		{
			// echo "Error: " . $sql2 . "<br>" . $conn->error;
		}

		//Set genres
		$genreTable = "SELECT * FROM Genres";		//get genre table count
		$resultGenre = $conn->query($genreTable);
		$genreCount = $resultGenre->num_rows;

		for($loopVar = 1; $loopVar <= $genreCount; $loopVar++)
		{
			if( isset($_POST[$loopVar]) )
			{
				$postVal = $_POST[$loopVar];

				$sqlInsertBandGenres = "INSERT INTO BandGenres (bandID, genreID) VALUES ('$last_id', '$postVal')";    //insert the picked genres into BandGenres

				if ($conn->query($sqlInsertBandGenres) === TRUE) //executes "$conn->query($sql);" to run the insert
				{
				} 
				else 
				{
					// echo "Error: " . $sqlInsertBandGenres . "<br>" . $conn->error;
				}
			}
		}


		//Set instruments
		if (isset($_POST['instruments']))
		{
			$postInstruments = $_POST['instruments'];
			$postInstrumentsCount = count($postInstruments);
			for($loopVar = 0; $loopVar < $postInstrumentsCount; $loopVar++)
			{
				$loopInstrumentID = $postInstruments[$loopVar];
				$sqlInstrumentAdd = "INSERT INTO BandWants (bandID, instrumentID) VALUES ('$last_id','$loopInstrumentID') ";
				$instrumentAdd = $conn->query($sqlInstrumentAdd);                
			}
		}
		header("Location: viewMyBands.php");		//send the viewer to view their bands
	}
	else        //if no form was sent, or loading page from external link
	{
		// echo "<br> form not submitted <br>";
	}
?>

<!DOCTYPE html>
<title>BandMates | Create Band</title>
<?php require_once('header.php'); ?>

<body>
<?php require_once('nav.php'); ?>


  <!-- ======= Intro Section ======= -->
  <section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="intro-img" data-aos="zoom-out" data-aos-delay="200" style="color:white;">
        <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
      </div>
        <div class='intro-info' data-aos='zoom-in' data-aos-delay='100'>
		
  
<?php

	if (isset($_SESSION['login_user']) == false)        //dont display form unless the user is logged in
	{
		echo "<br> You must be logged in to make a band";
	}
	else        //display form if the user is logged in
	{
    echo " <h1>Create a Band</h1>";
		echo "  <form action=\"\" method=\"post\"> 
		<label>Band Name: </label>
		<input name=\"bandName\" type=\"text\" placeholder=\"The Flavour Townspeople\" required>
		<br><br><br>
		<label>Temporary Jam Band? <br></label>
		<select name=\"bandJam\" require>
		<option value=\"0\">No</option>
		<option value=\"1\">Yes</option>
		</select>
		<br><br><br>
		<label>Show in feeds and searches? <br></label>
		<select name=\"feedBool\" require>
		<option value=\"1\">Yes</option>
		<option value=\"0\">No</option>
		</select> <br><br>";

		$sqlGenres = "SELECT * FROM Genres";
		$resultGenres = $conn->query($sqlGenres);
		if ($resultGenres->num_rows > 0)
		{
			echo "<br> <div><h3> Pick Your Band Genres:</h3> <br><br>";
			while($rowC = $resultGenres->fetch_assoc())
			{
        echo "<input type=\"checkbox\" id=\"" . $rowC["genreID"] . "\" name=\"" . $rowC["genreID"] . "\" value=\"" . $rowC["genreID"] . "\">";			//display genre checkboxes
        echo " ";
				echo "<label for=\"" . $rowC["genreID"] ."\"> " . $rowC["genreName"] . "</label> <br>";
			}
			echo "</div> <br>";
		}

		$sqlInstruments = "SELECT * FROM Instruments";
		$resultInstruments = $conn->query($sqlInstruments);
		if ($resultInstruments->num_rows > 0)
		{
			echo "<br> <div> <h3>Select what instruments you want to find for the band :</h3> <br>";
			while($rowD = $resultInstruments->fetch_assoc())
			{
        echo "<input type=\"checkbox\" id=\"i" . $rowD["instrumentID"] . "\" name=\"instruments[]\" value=\"" . $rowD["instrumentID"] . "\">";			//display instrument checkboxes
        echo " ";
				echo "<label for=\"i" . $rowD["instrumentID"] ."\"> " . $rowD["instrumentName"] . "</label> <br>";
			}
			echo "</div>";
    }
    echo "<br>";
		echo "<input type=\"submit\"> </form>";
	}
?>
          
 
        </div>
      </div>

    </div>
  </section><!-- End Intro Section -->

  <main id="main">

   
  </main><!-- End #main -->

  <?php require_once('footer.php'); ?>

</body>

</html>