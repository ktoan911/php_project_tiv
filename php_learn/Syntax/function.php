<?php
    function  writeMessage() {
        echo "Hello world!";
    }
    writeMessage();

    function familyName($fname, $year = "1990") {
        echo "$fname Refsnes. Born in $year <br>";
    }

    familyName("Jani");
    familyName("Hege", "1975");

    function sum(int $a, int $b): int {
        return $a + $b;
    }
?>