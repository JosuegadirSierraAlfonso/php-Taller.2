<?php
    /* N athletes have advanced to triple jump finals at the games
    2022 Women's Olympians. Design a program that asks for
    keyboard the names of each finalist athlete and in turn, their
    marks of the jump in meters. Inform the name of the athlete
    champion to keep the gold medal and if she broke
    record, report the payment that will be 500 million. the record
    It is at 15.50 meters.*/
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
        $names = array_column($_DATA, 'name');
    $brands = array_column($_DATA, 'brand');
    $registration = $_DATA;

    foreach ($names as $name) {
        if (!is_string($name) || empty(trim($name)) || !preg_match('/^[A-Za-z]+$/', $name)) {
            $res = "Error, The name cannot be numeric or contain numbers.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    };

    foreach ($brands as $brand) {
        if (!is_numeric($brand)) {
            $res = "Error: The Mark must be numeric.";
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit;
        }
    };

    $maxBrand = max($brands);
    $maxBrandIndex = array_search($maxBrand, $brands);

    $personMaxBrand = array(
        "name" => $names[$maxBrandIndex],
        "brand" => $maxBrand
    );

    $message = array(
        "Athlete List" => $_DATA,
        "Athlete With the Greatest Mark" => $personMaxBrand,
    );
    if ($maxBrand > 15.50) {
        $message["Congratulations!!!"] = "¡You've got it! You have won 500 Million for breaking the record.";
    };
    echo json_encode($message, JSON_PRETTY_PRINT);
    };
?>