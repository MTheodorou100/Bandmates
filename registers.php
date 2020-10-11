
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
//$password = $_POST['password'];
//$hash = md5_file($password);
//echo($hash);
//$sql = "INSERT INTO Person (username, password)
//VALUES ('$_POST[username]', $hash)";
	
	$now = new DateTime();
	$newDate = $now->format('Y-m-d H:i:s');
	
$sql = "INSERT INTO Person (username, password, dateOfBirth,lastLoginTime)
VALUES ('$_POST[username]', '$_POST[password]', '$_POST[birthday]', '$newDate')";
$_SESSION['login_user'] = $_POST['username'];
header("Location: finalizeprofile.php"); 

} else {
    header("Location: register.php");
} 
 

if ($db->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
</body>
</html>