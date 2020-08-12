
<html>
	<style>
@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
</style> 
	<link rel="stylesheet" href="../client/css.css">
<body>  
	<?php
$servername = utf8_encode("progdatabase-1.ctxbjl62xf2l.us-east-2.rds.amazonaws.com");
$dbname = utf8_encode("programmingdb");
$username = utf8_encode("root");
$password = utf8_encode("mypassword");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}     

$sql = "INSERT INTO Person (username, password)
VALUES ('$_POST[username]', '$_POST[password]'";
  
if ($conn->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
  

#$file = fopen('users.csv','a+'); //"w"=overwrite
#fwrite($file, $_POST['username']);
#fwrite($file, ",");
#fwrite($file, $_POST["password"]); 
#fwrite($file, ",");
#fwrite($file, $_POST["account"].PHP_EOL);
#fclose($file);
?>
	<h1>The user has been registered!</h1>
	<p> <a href="home.html">Click here</a> to return to main directory</p>
	
</body>
</html>