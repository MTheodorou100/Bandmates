<html>
    <body>
        <?php
            $userArray = [];    //init userArray
            $userArray[0][0] = "Adrian";
            $userArray[1][0] = "Breanna";
            $userArray[2][0] = "Callum";
            $userArray[3][0] = "Dangelo";

            $userArray[0][1] = 222;
            $userArray[1][1] = 444;
            $userArray[2][1] = 111;
            $userArray[3][1] = 333;
            
            var_dump($userArray);
            echo "<br>";
            // echo count($userArray); //its 4

            $scoreArray = $userArray;   //copy userArray into scoreArray

            for ($x = 0; $x < count($scoreArray); $x++)
            {
                for ($y = $x+1; $y < count($scoreArray); $y++)
                {
                    if ($scoreArray[$x][1]<$scoreArray[$y][1])
                    {
                        $temp = $scoreArray[$y][0];
                        $scoreArray[$y][0] = $scoreArray[$x][0];
                        $scoreArray[$x][0] = $temp;
                        
                        $temp = $scoreArray[$y][1];
                        $scoreArray[$y][1] = $scoreArray[$x][1];
                        $scoreArray[$x][1] = $temp;

                    }
                }
            }

            var_dump($scoreArray);

        ?>
    </body>
</html>