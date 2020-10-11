<!DOCTYPE html>
<title>BandMates | Create Profile</title>
<?php require_once('header.php'); ?>

	<?php  
    include("config.php");
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

    
     $sqlUserID = "SELECT personID FROM Person WHERE username='$_SESSION[login_user]';";
      $usersListResult = mysqli_query($db, $sqlUserID) or die(mysqli_error($db));
      $querysql = mysqli_fetch_array($usersListResult, MYSQL_ASSOC);
                 
    foreach($_POST['instruments'] as $loopInstrumentID) {
        $sqlInstrumentAdd = "INSERT INTO Plays (personID, instrumentID) VALUES ('$querysql[personID]','$loopInstrumentID');";
        $insertIntoBandWants = mysqli_query($db, $sqlInstrumentAdd) or die(mysqli_error($db));
    }
    
    foreach($_POST['genreArrayA'] as $loopGenreID) {
        $sqlGenreAdd = "INSERT INTO LikedGenres (personID, genreID) VALUES ('$querysql[personID]','$loopGenreID');";
        $insertIntoBandWants = mysqli_query($db, $sqlGenreAdd) or die(mysqli_error($db));
    }

    
    
    
if ($conn->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>

  <body>
  <?php require_once('nav.php'); ?>
    
        

    <section id="intro" class="clearfix">
    <div class="container">
        <h2 class="white">Success!</h2>
        <p class="white">Your profile has been created!</p>
       <br>
       <a href='profile.php'>Click Here to view profile</a>

    </div>    
        </section>
</body>
    
<?php require_once('footer.php'); ?>
</html>