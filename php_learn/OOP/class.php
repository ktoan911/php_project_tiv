<?php
    namespace OOP{
        class Person{
            private $name;
            private $age;
    
            //ko viết hàm nhưng vẫn chạy default contrctor
            public function __construct($name, $age) { 
                $this->name = $name;
                $this->age = $age;
            }
    
            public function getName() {
                return $this->name;
            }
    
            public function getAge() {
                return $this->age;
            }
        }
    
        $person1 = new Person("John", 30);
        echo "Name: " . $person1->getName() . "<br>";
    }
?>