<?php
//1 class kế thừa 1 abstract và nhiều interface
    interface DongVat{
        public function getName();
    }
    interface ConTrau extends DongVat{
        public function checkSung();
    }

    class conNghe implements ConTRau{
        private $name;
        const SUNG = false;
        
        public function getName() {
            return $this->name;
        }

        public function checkSung() {
            return self::SUNG ? "Con trâu này sung" : "Con trâu này không sung";
        }
    }


    //abstract class cần tối thiểu 1 abstract method
    abstract class DongVatAbstract {
        protected $name;

        public function run() {
            echo "Chạy nhanh<br>";
        }

        abstract public function getName();
    }
    class ConMeo extends DongVatAbstract implements DongVat {
        public function getName() {
            return $this->name;
        }
        public function run() {
            echo "Chạy chậm<br>";
        }
    }
?>