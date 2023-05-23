<?php
    /* Build the algorithm in Javascript for a program
    for any number of students reading the name,
    the sex and the final grade and find the student with the highest
    grade and the student with the lowest grade and how many were
    men and how many women.*/
    header("Content-Type: application/json; charset:UTF-8");
    $_DATA = json_decode(file_get_contents("php://input"), true);
    $METHOD = $_SERVER["REQUEST_METHOD"];

    $names = array_column($_DATA, 'name');
    $notes = array_column($_DATA, 'note');
    $registration = $_DATA;

    $counterM = 0;
    $counterF = 0;

    foreach ($registration as $registro) {
        $gender = $registro["gender"];
        if ($gender === "m") {
            $counterM++;
        } elseif ($gender === "f") {
            $counterF++;
        }
    }

    $maxNote = max($notes);
    $maxNoteIndex = array_search($maxNote, $notes);
    $minNote = min($notes);
    $minNotaIndex= array_search($minNote, $notes);

    $personMaxNote = array(
        "Name" => $names[$maxNoteIndex],
        "Note" => $maxNote
    );
    $personMinNote = array(
        "Name" => $names[$minNoteIndex],
        "Note" => $minNote
    );

    try {
        $res = match ($METHOD) {
            "POST" => algoritmo(...$_DATA)
        };
    } catch (\Throwable $th) {
        $res = "Error";
    }

    $message = array(
        "Students list" => $_DATA,
        "person with best score" => $personMaxNote,
        "person with the lowest score" => $personMinNote,
        "male students" => $counterM,
        "female students" => $counterF
    );

    echo json_encode($message, JSON_PRETTY_PRINT);
?>