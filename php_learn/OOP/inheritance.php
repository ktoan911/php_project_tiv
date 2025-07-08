<?php
    class Foo {
        public function printItem($string) {
            echo "Item: " . $string . "<br>";
        }
        public function printPHP() {
            echo "PHP is great!<br>";
        }
    }

    class Bar extends Foo {
        public function printItem($string) {
            echo "Item: " . $string . "<br>";
        }
        public function printPHP() {
            echo "PHP is awesome!<br>";
        }
    }

    $foo = new Foo();
    $foo->printPHP();
    $bar = new Bar();
    $bar->printPHP();
    
?>