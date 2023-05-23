<?php
    /* Build the algorithm that requests the name and age of 3
    people and determine the name of the oldest person. */
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    $names = array_column($_DATA, 'name');
    $ages = array_column($_DATA, 'age');
    $registration = $_DATA; 

    foreach ($names as $name) {
        if (!is_string($name) || empty(trim($name)) || !preg_match('/^[A-Za-z]+$/', $name)) {
            $res = "Error, The name cannot be numeric or contain numbers.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }
    foreach ($ages as $age) {
        if (!is_numeric($age)) {
            $res = "Error: Age must be numeric.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    }

    $maxAge = max($ages);
    $maxAgeIndex = array_search($maxAge, $ages);

    $personMaxAge = array(
        "Name" => $names[$maxAgeIndex],
        "Age" => $maxAge
    );

    try {
        $res = match($METHOD){
            "POST" => algoritmo(...$_DATA)
        };
    } catch (\Throwable $th) {
        $res = "Error";
    }

    $message = array(
        "Students list" => $_DATA,
        "Older Student" => $personMaxAge,
    );

    echo json_encode($message, JSON_PRETTY_PRINT);
?>