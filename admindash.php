<?php
   include("config.php");
   session_start();
?>
<html>
    <body>
    <script>
    </script>
    <h1>Admin Dashboard</h1>
            <title>Bandmates | Admin</title>
    <p>Welcome back <?php echo $_SESSION['aUser']; ?></p>
         <div class="topnav">
             <a href="adminaccounts.php">View Admin Accounts</a>
             <a href="adminmembers.php">View Member Accounts</a>
             <a href="adminbands.php">View Bands</a>
             <a href="signout.php">Logout</a>
        </div>
    
    </body>
</html>