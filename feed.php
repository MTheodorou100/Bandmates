<!DOCTYPE html>

<html lang="en">
  <?php
    error_reporting(E_ERROR | E_PARSE);
  session_start();
  include("config.php");
  ?>
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
	if($db == false)
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	$sqlPI = "SELECT * 
	FROM Person 
	WHERE username = '{$_SESSION['login_user']}'";
	$resultPI = mysqli_query($db, $sqlPI) or die(mysqli_error($db)); 

	// $sqlPG = "SELECT prefGenre 
	// FROM Person 
	// WHERE username = '{$_SESSION['login_user']}'";
	// $resultPG = mysqli_query($db, $sqlPG) or die(mysqli_error($db));

	// echo $_SESSION['login_user'];
	// echo "<br>";
	// echo $sqlPI;
	// echo "<br>";
	// echo $resultPI;
	// echo "<br>";
	// echo "<br>";
	if (mysqli_num_rows($resultPI) > 0) 
	{
		while($row = mysqli_fetch_array($resultPI, MYSQL_ASSOC))                  //get user's preference
		{
			// $resultsPI = "prefInstrument = " . $row["prefInstrument"]. "<br>";
			// echo "<div style=\"color:white\">";
			// echo "resultsPI= ";
			// echo $resultsPI;

			// echo $row["prefInstrument"];

      // echo "</div>";
      $myPrefIns = $row["prefInstrument"];
      $myPrefGen = $row["prefGenre"];
      echo "myPrefIns = ". $myPrefIns;
      echo "myPrefGen = ". $myPrefGen;
		}
	} 
	else 
	{
		echo "0 results for resultPI";
	}

	// echo $sqlPG;
	// echo "<br>";
	// echo "<div>testdiv</div>";

	// $item = ($_GET['item']);    //change to the user's current preference (as set in their profile edit)
	// $item = ("guitar");

	$sql = "SELECT * FROM Person WHERE instrument LIKE '%".$myPrefIns."%' OR genre LIKE '%".$myPrefGen."%'";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));


	if (mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
		{
			$results = "Name: " . $row["firstName"]. " " . $row["surName"]. " " . $row["instrument"]. " " . $row["genre"]. "<br>";			//needs to be changed from the current user to searching the entire database for the current users preference
			echo "<div>";
			echo $results;
      echo "</div>";
      
		}

	} 
	else 
	{
		echo "0 results";
	}

	// if (mysqli_num_rows($resultPG) > 0) 
	// {
	// 	while($row = mysqli_fetch_array($resultPG, MYSQL_ASSOC)) 
	// 	{
	// 		$resultsPG = "Name: " . $row["firstName"]. " " . $row["surName"]. " " . $row["instrument"]. " " . $row["genre"]. "<br>";
	// 		echo "<div>";
	// 		echo $resultsPG;
	// 		echo "</div>";
	// 	}
	// }
	// else 
	// {
	// 	echo "0 results";
	// }


	$db->close();
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