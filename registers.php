
<html>
	<style>
@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
</style> 
	<link rel="stylesheet" href="../client/css.css">
<body>  
	<?php

	      session_start();  
		  include("config.php");

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}     


if ($_POST['password']==$_POST['confirm_password']){
$password = $_POST['password'];
$hash = md5_file($password);
echo($hash);
$sql = "INSERT INTO Person (username, password)
VALUES ('$_POST[username]', $hash)";
$_SESSION['login_user'] = $_POST['username'];
header("Location: eprofile.php"); 

} else {
    header("Location: register.php");
} 
 

if ($db->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
	<h1>The user has been registered!</h1>
	<p> <a href="home.html">Click here</a> to return to main directory</p>
	
</body>
</html>