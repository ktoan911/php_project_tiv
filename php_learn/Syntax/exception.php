<?php
    function inverse($x) {
        if (!$x) {
            throw new Exception("Division by zero.\n");
        }
        return 1 / $x;
    }
    try {
        echo inverse(null) . "<br>";
        echo inverse(0) . "<br>";
    } catch (Exception $e) {
        echo "Caught exception: " . $e->getMessage() . "<br>";
    } finally { //chắc chặn chạy dù có excp ko
        echo "Execution completed.<br>";
    }

?>