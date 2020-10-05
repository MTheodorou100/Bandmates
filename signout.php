   <?php   
session_start();   
session_destroy();
header("Location: index.php"); 
if ($_SESSION['aUser']!=null){
   header("Location: adminlogin.php");
}
            ?>