            <?php   
            session_start();         
            ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Bandmates | Create a Profile</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">


    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  
  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="register.css" rel="stylesheet">
  </head>

        <body class="text-center">

        	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Bandmates</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.html">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="register.php" tabindex="-1" aria-disabled="true">Register</a>
      </li>
          </ul>
  </div>
</nav>
   		 <form class="form-register" action="home.html" method='POST'>
 		 <h1 class="h3 mb-3 font-weight-normal">Create a Profile</h1>

<div class="fname">
  <label for="firstname">First Name:</label>
  <input type="text" id="inputFName" class="form-control">
</div>

<div class="lname">
  <label for="lastname">Last Name:</label>
  <input type="text" id="inputLName" class="form-control">
</div>

<div class="instrument">
  <label for="instrumentSelect">Instrument Played:</label>
	<select name="instrument" id='instrument'>
                    <option value="Guitar">Guitar</option>
                    <option value="Bass Guitar">Bass Guitar</option>
                    <option value="Drums">Drums</option>
                    <option value="Vocals">Vocals</option>
    </select>
</div>

<div class="genre">
  <label for="genreSelect">Preferred Genre:</label>
	<select name="genre" id='genre'>
                    <option value="Rock">Rock</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Metal">Metal</option>
                    <option value="RnB">RnB</option>
    </select>
</div>
                           
 <button class="button-register" type="submit" href="home.html">Register</button>
         
         </form>
    </body>
</html>
