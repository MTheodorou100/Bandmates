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
                <form action="/profile.php">
                    First Name
                    <br>
                    <input type="text">
                    <br>
                    Last Name
                    <br>
                    <input type="text">
                    <br>
                    Select Instruments
                    <br>
                    <input type="checkbox" id="instr1" value="Guitar">
                    <label for="instr1"> Guitar </label>
                    <br>
                    <input type="checkbox" id="instr2" value="Bass Guitar">
                    <label for="instr2"> Bass Guitar </label>
                    <br>
                    <input type="checkbox" id="instr3" value="Drums">
                    <label for="instr3"> Drums </label>
                    <br>
                    Select Genres
                    <br>
                    <input type="checkbox" id="genre1" value="Rock">
                    <label for="genre1"> Rock </label>
                    <br>
                    <input type="checkbox" id="genre2" value="Jazz">
                    <label for="genre2"> Jazz </label>
                    <br>
                    <input type="checkbox" id="genre3" value="Metal">
                    <label for="genre3"> Metal </label>
                    <br>
                    <br>
                    <input type="submit">
                </form>
            </section>
        </main>
    </body>
</html>
