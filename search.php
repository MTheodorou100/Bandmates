<!DOCTYPE html>

<?php require_once('header.php'); ?>

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

  <!-- ======= Intro Section ======= -->
  <section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="intro-img" data-aos="zoom-out" data-aos-delay="200" style="color:white;">
        <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
      </div>
        <div class='intro-info' data-aos='zoom-in' data-aos-delay='100'>
  
        <?php
  if($db == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  if ($_GET['band'] != null) {
  $band = ($_GET['band']);    

  $sql = "SELECT * FROM Band WHERE bandName LIKE '%".$band."%' ";
  $result = mysqli_query($db, $sql) or die(mysqli_error($db));
  

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
      $results = "Name: " . $row["bandName"]. " " . $row["bandGenre"]. "<br>";
      foreach ($results as $id) {
        echo '<div class="card bg-primary" style="width: 12rem;">
        <div class="card-body">
        <h5 class="card-title">' . $id['bandName'] . '</h5>
        <h6 class="card-subtitle mb-2 text-muted"></h6>
        <p class="card-text">' . $id['bandGenre'] . '</p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
        </div>
        </div>
        </div>
        <?php
        echo "hello"';
      }
    }
 
  } else {
    echo "0 results";
  }
}

if ($_GET['person'] !=null) {
  $person = ($_GET['person']);    

  $sql = "SELECT * FROM Person WHERE instrument LIKE '%".$person."%' OR genre LIKE '%".$person."%'";
  $result = mysqli_query($db, $sql) or die(mysqli_error($db));
  

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
      $results = "Name: " . $row["firstName"]. " " . $row["surName"]. " " . $row["instrument"]. " " . $row["genre"]. "<br>";
      echo $results;
    }
  } else {
    echo "0 results";
  }
}
  $db->close();
?>
          
 
        </div>
      </div>

    </div>
  </section><!-- End Intro Section -->

  <main id="main">

   
  </main><!-- End #main -->

  <?php require_once('footer.php'); ?>

</body>

</html>
