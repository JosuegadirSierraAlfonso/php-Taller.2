<?php
    "Build the algorithm for a program that inputs three
    grades of a student, if the average is less than or equal to 3.9
    display a message 'Study', otherwise a message that
    say 'scholarship'";

    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    function validate($arg){
        return ($arg<=3.9) ? "Estudie" : "becado";
    }

    function algorithm(float $note1, float $note2, float $note3){
        $average = ($note1+$note2+$note3)/3;
        return validate($average);

    }
    try{
        $res = match($METHOD){
            "POST" => algorithm(...$_DATA)
        };
    }catch (\throwable $th){
        $res = "ERROR";
    }
    
    $message = (array) [
        "message"=> validate($res),
        "notes"=> $_DATA,
        "average"=> $res 
    ];
    echo json_encode( $message,JSON_PRETTY_PRINT);

?>