<?php
    /* Develop a cyclical program that captures a piece of data
     number each time, and accumulate them. The program will
     stops when the user types a zero. The program must
     show: THE SUM OF THE VALUES, THE VALUE OF THE
     AVERAGE, HOW MANY VALUES WERE ENTERED, MAYOR
     VALUE AND LESS VALUE.*/
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    try {
        $res = match($METHOD){
            "POST" => algorithm(...$_DATA)
        };
    } catch (\Throwable $th) {
        $res = "Error";
    };

    function algorithm(){
        global $_DATA;
        $numbers = array_column($_DATA, 'num');
    $registration = $_DATA;

    if (in_array(0, $numbers)) {
        $res = "You're out";
        echo json_encode($res, JSON_PRETTY_PRINT);
        exit;
    }

    foreach ($numbers as $number) {
        if (!is_numeric($number)) {
            $res = "Error: Values must be numeric.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    $totally = array_sum($numbers);
    $count = count($numbers);
    $average = $totally / $count;
    $maxVal = max($numbers);
    $minVal = min($numbers);

    $message = array(
        "Entered Numbers" => $_DATA,
        "Total amount" => $totally,
        "Number of Data Entered" => $count,
        "Total average" => $average,
        "The number with the greatest value is:" => $maxVal,
        "The number with the least value is:" => $minVal,
    );

    echo json_encode($message, JSON_PRETTY_PRINT);
    }
?>