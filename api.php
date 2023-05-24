<?php
    /* Program that enters by keyboard:
    a. the value of the side of a square to display on the screen the
    perimeter of the same
    b. the base and height of a rectangle to show the area of the
    same*/
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    if (is_numeric($_DATA['square']) && is_numeric($_DATA['heigth']) && is_numeric($_DATA['base'])) {
        $square = $_DATA['square'];
        $heigth = $_DATA['heigth'];
        $base = $_DATA['base'];

        function perimeter(float $square)
        {
            $perimeter = $square * 4;
            return $perimeter;
        }

        function area(float $heigth, float $base)
        {
            $area = $heigth * $base;
            return $area;
        }

        try {
            $res = match ($METHOD) {
                "POST" => [
                    "Perimeter of the square is:" => perimeter($square),
                    "Height of the rectangle is:" => area($heigth, $base),
                ],
            };
        } catch (\Throwable $th) {
            $res = "Error";
        }

        $message = array(
            "Information" => $_DATA,
            "Result" => $res,
        );

        echo json_encode($message, JSON_PRETTY_PRINT);
    } else {
        echo "Values must be numeric.";
    }
?>