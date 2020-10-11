<!DOCTYPE html>
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
      
          
 <?php
    if ( $_SESSION['login_user']==null){
    echo "<header id='header' class='fixed-top'>
    <div class='container'>

      <div class='logo float-left'>
        <!-- Uncomment below if you prefer to use an text logo -->
        <!-- <h1><a href='index.html'>NewBiz</a></h1> -->
        <a href='index.php'><img src='assets/img/logo.png' alt='' class='img-fluid'></a>
      </div>

      <nav class='main-nav float-right d-none d-lg-block'>
        <ul>

          
          <li class='active'><a href='index.php'>Home</a></li>
          <li><a href='login.php'>Login</a></li>
          <li><a href='register.php'>Register</a></li>
            <li><a href='service.php'>Terms of Service</a></li>
             <li><a href='policy.php'>Privacy Policy</a></li>
        </ul>
      </nav><!-- .main-nav -->
      </div>
    </header>";
    } else {
        echo "<header id='header' class='fixed-top'>
    <div class='container'>

      <div class='logo float-left'>
        <!-- Uncomment below if you prefer to use an text logo -->
        <!-- <h1><a href='index.html'>NewBiz</a></h1> -->
        <a href='index.php'><img src='assets/img/logo.png' alt='' class='img-fluid'></a>
        <a href='index.php'>Logged in as ".$_SESSION['login_user']." </a>                               
      </div>


      <nav class='main-nav float-right d-none d-lg-block'>
        <ul>

          
          <li class='active'><a href='index.php'>Home</a></li>
            <li><a href='service.php'>Terms of Service</a></li>
             <li><a href='policy.php'>Privacy Policy</a></li>
             <li><a href='profile.php'>My Profile</a></li>
             <li><a href='signout.php'> Sign Out </a></li>
             
        </ul>
        
        
      </nav><!-- .main-nav -->
      </div>
    </header>";
    }
    
    ?> 
    
        

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