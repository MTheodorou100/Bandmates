            <?php   
            session_start();  
             echo $_SESSION['login_user'];
           
            ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="style.css"> 
        <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
    </head>

    <body>
        <header>
            Bandmates Profile
        </header>

        <nav>
           <a href="home.html">Home </a>
           <a href="register.html"> Register </a>
           <a href="bands.html"> Bands</a>
        </nav>

        <main>
            <section>
                <form action="cprofile.php" method='POST'>
                    First Name
                    <br>
                    <input type="text" name="fname">
                    <br>
                    Last Name
                    <br>
                    <input type="text" name="lname">
                    <br>
                    Favourite Instrument
                    <br>
                    <select name="instrument" id='instrument'>
                    <option value="Guitar">Guitar</option>
                    <option value="Bass Guitar">Bass Guitar</option>
                    <option value="Drums">Drums</option>
                    </select>
                    <br>
                    Favourite Genre
                    <br>
                    <select name="genre" id='genre'>
                    <option value="Rock">Rock</option>
                    <option value="Jazz">Jazz</option>
                    <option value="Metal">Metal</option>
                    </select>
                    <br>
                    <br>
                    <input type="submit">
                </form>
            </section>
        </main>
    </body>
</html>
