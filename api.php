<?php
    /* Build the algorithm to determine the voltage of a
    circuit based on resistance and current. */
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    function validate($arg){
        return ("$arg volts") ;
    }
    function algorithm(float $note1,float $note2){   
        $voltage = $note1 * $note2;
        return $voltage;
    }

    try {
    $res = match($METHOD){
        "POST" => algorithm(...$_DATA)
    };
    }catch (\Throwable $th) {
    $res = "ERROR";

    };
    $message = (array) [
        "Voltage"=> validate($res),
    ];
    echo json_encode( $message,JSON_PRETTY_PRINT);
?>