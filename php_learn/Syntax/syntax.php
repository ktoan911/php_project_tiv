<!-- variable -->
<?php
    $txt = "Hello world";
    $x = 5;
    $y = 10.5;
    $b = true; 
    $cars = array("Volvo", "BMW", "Toyota");
    $n = null;

    //link
    $tx1 = "Hello world";
    $tx1 .= "!";


    //if
    $t = date("H");
    if ($x < "20") {
        echo" Good day!";
    } elseif ($x < "10") {
        echo "Good morning!";
    } elseif ($x < "15") {
        echo "Good afternoon!";
    } else {
        echo "Good evening!";
    }

    // switch-case
    $favcolor = "red";
    switch($favcolor) {
        case "red":
            echo "Your favorite color is red!";
            break;
        case "blue":
            echo "Your favorite color is blue!";
            break;
        case "green":
            echo "Your favorite color is green!";
            break;
        default:
            echo "Your favorite color is neither red, blue, nor green!";
    }

    //while
    $x = 1;
    while($x <= 5) {
        echo "The number is: $x <br>";
        $x++;
    }
    //do-while
    $x = 1;
    do{
        echo "The number is: $x <br>";
        $x++;
    } while ($x <= 5);
    //for
    for ($x = 0; $x <= 5; $x++) {
        echo "The number is: $x <br>";
    }
    //foreach
    $colors = array("red", "green", "blue");
    foreach ($colors as $value) {
        echo "$value <br>";
    }

    //arrays
    $array = [];
    $array = array();

    $cars = array("Volvo", "BMW", "Toyota");
    //associative array
    $age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
    $age["Peter"] = "35";

    //multidimensional array
    $cars = array(
        array("Volvo", 22, 18),
        array("BMW", 15, 13),
        array("Toyota", 5, 2)
    );

    echo $cars[0][0] . ", " . $cars[0][1] . ", " . $cars[0][2] . "<br>";


    
?>
