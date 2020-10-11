<!DOCTYPE html>
 <?php require_once('header.php'); ?>
 
<body>

    <?php
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

          
        <li ><a href='index.php'>Home</a></li>
        <li ><a href='makeBand.php'>Create a Band</a></li>
        <li class='active'><a href='viewMyBands.php'>View my Bands</a></li>
          <li><a href='service.php'>Terms of Service</a></li>
           <li><a href='policy.php'>Privacy Policy</a></li>
           <li><a href='profile.php'>My Profile</a></li>
           <li><a href='signout.php'> Sign Out </a></li>
             
        </ul>
        
        
      </nav><!-- .main-nav -->
      </div>
    </header>";
    
    
    ?> 
    <body>
    <section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="intro-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
      </div>
        <h1>
            viewBands Page
        </h1>
        <?php
            session_start();  
            $servername = utf8_encode("35.197.167.52");
            $dbname = utf8_encode("bandmates");
            $username = utf8_encode("root");
            $password = utf8_encode("mypassword");
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            

            if (isset($_SESSION['login_user']) == false)        //dont display unless the user is logged in
            {
                echo "<br> You must be logged in to view your bands";
            }
            else        //display bands if the user is logged in
            {
                echo "<div> You're logged in as: " . $_SESSION['login_user'] . "</div> <br>";
                
                $currentUsername = $_SESSION['login_user'];
                //Get the personID of the user to set as a bandmember
                $sqlPID = "SELECT personID FROM Person WHERE username = '$currentUsername'";
                $resultPID = $conn->query($sqlPID);
                if ($resultPID->num_rows > 0)
                {
                    while($row = $resultPID->fetch_assoc())
                    {
                        $personID = $row["personID"];
                    }
                }
                else
                {
                    echo "0 results";
                }
                //Get the user's bands
                $sqlBands = "SELECT * FROM Band WHERE bandID in (SELECT bandID FROM BandMembers WHERE personID = '$personID')";
                $resultBands = $conn->query($sqlBands);
                
                //get count of user's bands
                $sqlBandsCount = $resultBands->num_rows;
                echo "<div> You are a part of " . $sqlBandsCount . " bands: </div> <br>";

                if ($resultBands->num_rows > 0)
                {
                    while($row = $resultBands->fetch_assoc())
                    {
                        echo "<div>";
                        echo "bandID = " . $row["bandID"] . "<br>";
                        echo "bandName = " . $row["bandName"] . "<br>";
                        // echo "bandGenre = " . $row["bandGenre"] . "<br>";
                        // echo "Are you the leader? MUST BE FIXED " . $row["bandJamBool"] . "<br>";
                        // echo "(edit link)";
                        echo "<a href=\"band.php?band=" . $row["bandID"] . "\">View Band</a>";
                        echo "</div>";
                        echo "<br>";
                    }
                }
                else
                {
                    echo "0 results";
                }
            }
        ?>
        </div>
        </div>
  </section><!-- End Intro Section -->

  <main id="main">
  <?php require_once('footer.php'); ?>
    </body>
</html>