<!DOCTYPE html>

<?php require_once('header.php'); ?>

<body>

<?php require_once('nav.php'); ?>

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
