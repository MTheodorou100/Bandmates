
<html>
	<style>
@import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
</style> 
	<link rel="stylesheet" href="../client/css.css">
<body>  
	<?php

session_start();  
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
$instrument= $_POST['instrument'];
$genre= $_POST['genre'];
$username= $_SESSION['login_user'];

$sql = "UPDATE Person SET firstName='$_POST[fname]', surName='$_POST[lname]', instrument='$_POST[instrument]', genre='$_POST[genre]' WHERE username='$_SESSION[login_user]'";
  
if ($conn->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
	<h1>The user has been registered</h1>
	<p> ToDo Displaying Profile Section</p>
	
	<main>
            <section>
                Username:
                <div>
                    <!-- fill with php echo -->
                </div>
            </section>
            <section>
                First Name:
                <div>
                    <!-- fill with php echo -->
                </div>
            </section>
	    <section>
                Last Name:
                <div>
                    <!-- fill with php echo -->
                </div>
            </section>
            <section>
                Your Band History:
                <div>
                    <!-- fill with php echo -->
                </div>
       	    </section>
	    <section>
                Instruments Played:
                <div>
                    <!-- fill with php echo -->
                </div>
            </section>
            <section>
                Genre Interests:
                <div>
                    <!-- fill with php echo -->
                </div>
            </section>
            <section>
                Account Creation Date:
                <div>
                    <!-- fill with php echo -->
                </div>
            </section>
        </main>

</body>
</html>
