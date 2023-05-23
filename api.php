<?php
    /* Given a number indicate if it is even or odd and if it is greater than 10 */
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    function validate($arg){
        return ($arg == 0) ? "Pair" : "Odd";
    }
    function validatte($arg){
        return ($arg > 10) ? "The number $arg is greather than 10" : "The number $arg is less than 10";
    }
    function algorithm(float $note1){   
        $num = $note1 % 2;
        return $num;
    }
    function algoritthm( float $note1){
        return $note1;
    }
    try {
    $res = match($METHOD){
        "POST" => algorithm(...$_DATA)
    };
    $res2 = match($METHOD){
        "POST" => algoritthm(...$_DATA)
    };
    }catch (\Throwable $th) {
    $res = "ERROR";
    $res2 = "ERROR";
    };

    $message = (array) [
        "type"=> validate($res),
        "validate" => validatte($res2)
    ];
    echo json_encode( $message,JSON_PRETTY_PRINT);
?>