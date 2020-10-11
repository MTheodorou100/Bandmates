<?php
   
  session_start();
  include("config.php");
   if($db == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  $item = ($_GET['item']);    

  $sql = "SELECT * FROM Person WHERE username='$_SESSION[login_user]'";
  $result = mysqli_query($db, $sql) or die(mysqli_error($db));
  
  $row = mysqli_fetch_array($result, MYSQL_ASSOC);


      $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
      $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
      $querysql = mysqli_fetch_array($usersListResult, MYSQL_ASSOC);

    
     
     
      
?>




<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
<?php require_once('header.php'); ?>

<body>

<?php require_once('nav.php'); ?>    

    <section id="intro" class="clearfix">
    <div class="container">
     <center><h2 class="white">Your Profile</h2><br></center> 
      <div class="card bg-primary">
  <img src="assets/img/empty.png" style="width:100%">
  <h1><?php echo $row['firstName']; ?> <?php echo $row['surName'];?></h1>

        <p><b>Genres:</b> 
          <?php 
          $genresql = "SELECT genreName FROM Genres WHERE genreID IN (SELECT genreID FROM LikedGenres WHERE personID=$querysql[personID])";
          $resultGenre = mysqli_query($db, $genresql) or die(mysqli_error($db));
          while ($rowA = mysqli_fetch_array($resultGenre, MYSQL_ASSOC)){
            echo $rowA['genreName']." ";
          }?>
          
        </p>
        <p><b>Instruments:</b> 
          <?php 
          $instrumentsql = "SELECT instrumentName FROM Instruments WHERE instrumentID IN (SELECT instrumentID FROM Plays WHERE personID=$querysql[personID])";
          $resultinstrument = mysqli_query($db, $instrumentsql) or die(mysqli_error($db));
          while ($rowA = mysqli_fetch_array($resultinstrument, MYSQL_ASSOC)){
            echo $rowA['instrumentName']." ";
          }?>
        </p>
         <center><p><b>Bio</b></p></center> 
				<p> <?php echo $row['bio'];?></p>
         <center><p><b>Previous Experience</b></p></center>
         <p> <?php echo $row['preExp'];?></p>
         <center><p><b>Contact Email</b></p></center>
         <p> <?php echo $row['email'];?></p>

</div>
			<div class="form-group">
                <span class="help-block"></span>
            </div>
			<div class="form-group">
				<p></p>
             <center><a href='editprofile.php' class='button'>Edit Profile</a></center> 
                <span class="help-block"></span>
            </div>
    </div>    
        </section>
</body>
 
<?php require_once('footer.php'); ?>
</html>