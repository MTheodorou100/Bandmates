<!DOCTYPE html>
<html lang="en">
    <body>
        SHOULD ONLY LOAD IF USER IS LOGGED IN AND IN SESSION

        <?php 
            // $_SESSION['login_user'] = "poop" //uncomment to test echo in form
        ?>

        <form action="" method="post"> 
            <label>Band Name</label>
            <input name="bandName" type="text" placeholder="The Flavour Townspeople" required>
            <br>
            <label>Band Genre</label>
            <input name="bandGenre" type="text" placeholder="Post-Industrial" required>
            <br>
            <label>Band Leader</label>
            <input name="BandLeader" type="text" value="<?php echo $_SESSION['login_user'] ?>" required readonly>
        </form>
    </body>
</html>