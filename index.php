
<!DOCTYPE html>
<title>BandMates | Home</title>
<?php require_once('header.php'); ?>

<body>

<?php require_once('nav.php'); ?>

  <!-- ======= Intro Section ======= -->
  <section id="intro" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="intro-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
      </div>
        <div class='intro-info' data-aos='zoom-in' data-aos-delay='100'>
 <?php if ( $_SESSION['login_user']==null){
      echo "<h2>Find your ideal <br><span>Band</span><br>today!</h2>
        <div>
          <a href='register.php' class='btn-services scrollto'>Click Here to Register</a>
        </div>";
                    
}?>
          
 
        <div>

        </div>
      </div>

    </div>
  </section><!-- End Intro Section -->

  <main id="main">

   
  </main><!-- End #main -->

  <?php require_once('footer.php'); ?>

</body>

</html>