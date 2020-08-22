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

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  

    <!-- Custom styles for this template -->
    <link href="register.css" rel="stylesheet">
  </head>

        <body class="text-center">
   		 <form class="form-register" action="dprofile.php" method='POST'>
 		 <h1 class="h3 mb-3 font-weight-normal">Create a Profile</h1>

<div class="fname">
  <label for="firstname" class="sr-only">First Name</label>
  <input type="text" id="inputFName" class="form-control">
</div>

<div class="lname">
  <label for="lastname" class="sr-only">Last Name</label>
  <input type="text" id="inputLName" class="form-control">
</div>

<div class="instrument">
  <label for="instrumentSelect" class="sr-only">Instrument Played</label>
	<select name="instrument" id='instrument'>
                    <option value="Guitar">Guitar</option>
                    <option value="Bass Guitar">Bass Guitar</option>
                    <option value="Drums">Drums</option>
                    <option value="Vocals">Vocals</option>
    </select>
</div>

<div class="genre">
  <label for="genreSelect" class="sr-only">Preferred Genre</label>
	<select name="genre" id='genre'>
                    <option value="Rock">Rock</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Metal">Metal</option>
                    <option value="RnB">RnB</option>
    </select>
</div>
                           
 <button class="button-register" type="submit">Register</button>
         
         </form>
    </body>
</html>
