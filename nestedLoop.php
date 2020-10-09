<html>
    <body>
        <?php
            $userArray = [];    //init userArray
            $userArray[0][0] = "Adrian";
            $userArray[1][0] = "Breanna";
            $userArray[2][0] = "Callum";
            $userArray[3][0] = "Dangelo";

            $userArray[0][1] = 15;
            $userArray[1][1] = 35;
            $userArray[2][1] = 5;
            $userArray[3][1] = 25;
            
            // var_dump($userArray);
            // echo "<br>";

            $scoreArray = $userArray;   //copy userArray into scoreArray

            // for($p = 0; $p < count($userArray);  $p++)  //go through every value of userArray
            // {
            //     // echo "userArray[".$p."] = ".$userArray[$p];
            //     // echo "<br>";

            //     for($c = 0; $c < count($userArray);  $c++)  //go through every value of scoreArray
            //     {
            //         if($userArray[$c]>$userArray[$p])
            //         {
            //             $temp = $scoreArray[$p];
            //             $scoreArray[$p] = $scoreArray[$c];
            //             $scoreArray[$c] = $temp;
            //         }
            //     }
            // }

            // for ($i = 0; $i < count($userArray); $i++)
            // {
            //     for ($n = 1; $n < $i; $n++)
            //     {
            //         if ($userArray[$n] < $userArray[$i])
            //         {
            //             $temp = $userArray[$i];
            //             $userArray[$i] = $userArray[$n];
            //             $userArray[$n] = $temp;
            //         }
            //     }
            // }

            for($parent = 0; $parent < count($userArray); $parent++)
            {
                echo "comparing parent " . $userArray[$parent][0] . " " . $userArray[$parent][1] . " against...";
                echo "<br>";

                for($child = 0; $child < count($userArray); $child++)
                {
                    echo "child : " . $userArray[$child][0];
                    echo " " . $userArray[$child][1];
                    if ($userArray[$child][1]>$userArray[$parent][1])
                    {
                        echo "   MORE";
                        $scoreArray[$child][0] = $userArray[$parent][0];
                        $scoreArray[$child][1] = $userArray[$parent][1];
                    }
                    else if ($userArray[$child][1]<$userArray[$parent][1])
                    {
                        echo "   less";
                    }
                    else
                    {
                        echo " equal";
                    }
                    
                    echo "<br>";
                    // if($userArray[$child]>$userArray[$parent])  //if the currently iterated value is more than
                    // {
                    //     $temp = $scoreArray[$parent];
                    //     $scoreArray[$parent] = $scoreArray[$child];
                    //     $scoreArray[$child] = $temp;
                    // }
                }
                echo "<br>";
            }

            var_dump($scoreArray);

        ?>
    </body>
</html>