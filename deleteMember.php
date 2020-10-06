<!DOCTYPE html>
<html lang="en">
    <body>
        <?php
            include ("config.php");
            $thisBandID = 17;
            $loopPersonID = 138;
            $sqlBandDelete = "DELETE FROM bandMembers WHERE bandID = '$thisBandID' AND personID = '$loopPersonID';";
            $result = mysql_query($db, $sqlBandDelete) or die(mysql_error($db));

        ?>
    </body>
</html>