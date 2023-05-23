<?php
    /* Build the algorithm to determine the voltage of a
    circuit based on resistance and current. */
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];
    if (is_numeric($_DATA["note1"]) && is_numeric($_DATA["note2"])) {
        $note1 = $_DATA["note1"];
        $note2 = $_DATA["note2"];

        function algorithm(float $note1,float $note2){   
            $voltage = $note1 * $note2;
            return $voltage;
        }
    
        $voltage = algorithm($note1, $note2);
    
    try {
        $res = match($METHOD){
            "POST" => algorithm(...$_DATA)
        };
        }catch (\Throwable $th) {
        $res = "ERROR";

        };
        $message = (array) [
            "Voltage" => "$voltage voltios"
        ];
        echo json_encode( $message,JSON_PRETTY_PRINT);
    } else {
        echo "Los valores deben ser numericos";
    };
?>