<?php
    /* Build the algorithm that reads two numbers from the keyboard,
If the first is greater than the second, report their sum and
difference, otherwise, inform the product and the
division of the first by the second */
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    if (is_numeric($_DATA["num1"]) && is_numeric($_DATA["num2"])) {
        $num1 = $_DATA["num1"];
        $num2 = $_DATA["num2"];
        $totally = $num1 + $num2;
        $product = $num1 * $num2;
        $less = $num2 - $num1;
        $division = $num2 / $num1;
    
        if ($num1 > $num2) {
            $message = array(
                "message" => "The sum is $totally and its product is $product"
            );
            echo json_encode($message, JSON_PRETTY_PRINT);
        } else {
            $message = array(
                "message" => "The less is $less and its division is $division"
            );
            echo json_encode($message, JSON_PRETTY_PRINT);
        }
        try {
            $res = match ($METHOD) {
                "POST" => algoritmo(...$_DATA)
            };
        } catch (\Throwable $th) {
            $res = "Error";
        }
    
    }else{
        echo "Los valores deben ser numericos";
    }
?>