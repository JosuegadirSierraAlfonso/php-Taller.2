<?php
    /* Program that requests the entry of the name and price of an item and the
    quantity carried by the customer. Show what the buyer must pay
    on your bill.*/
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    try {
        $res = match ($METHOD) {
            "POST" => algorithm()
        };
    } catch (\Throwable $th) {
        $res = "Error";
    };
    
    function algorithm()
    {
        global $_DATA;
        $names = array_column($_DATA, 'nameP');
        $prices = array_column($_DATA, 'price');
        $amounts = array_column($_DATA, 'amount');
        $registration = $_DATA;
    
        foreach ($names as $name) {
            if (!is_string($name) || empty(trim($name)) || !preg_match('/^[A-Za-z]+$/', $name)) {
                $res = "Error, el nombre no puede ser numerico ni contener numeros";
                echo json_encode($res, JSON_PRETTY_PRINT);
                exit;
            }
        }
        foreach ($prices as $price) {
            if (!is_numeric($price)) {
                $res = "Error: El precio debe ser numeric.";
                echo json_encode($res, JSON_PRETTY_PRINT);
                exit;
            }
        }
        foreach ($amounts as $amount) {
            if (!is_numeric($amount)) {
                $res = "Error: La cantidad debe ser numerica.";
                echo json_encode($res, JSON_PRETTY_PRINT);
                exit;
            }
        }
    
        $subtotally = array_map(function ($price, $amount) {
            return $price * $amount;
        }, $prices, $amounts);
    
        $totally = array_sum($subtotally);
        $productsSubtotally = array_combine($names, $subtotally);
    
        $message = array(
            "Lista de Productos" => $_DATA,
            "Productos" => $productsSubtotally,
            "Total" => $totally
        );
        echo json_encode($message, JSON_PRETTY_PRINT);
    }
    
    
?>