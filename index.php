<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

(!isset($_GET["voto"]) || $_GET["voto"] == "all") ? $voto = "all" : $voto = $_GET["voto"];
(!isset($_GET["park"]) || $_GET["park"] == "all") ? $park = "all" : $park = $_GET["park"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .container ul {
            margin: 2em auto;
            width: 500px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>PHP Hotels</title>
</head>

<body>
    <!-- <pre>
        <?php
        var_dump($_GET);
        var_dump($park);
        var_dump($voto);
        ?>
    </pre> -->
    <div class="container">

        <h1 class="text-center my-5">PHP Hotels</h1>
        <hr>

        <!-- Filtri -->

        <h2 class="my-5 text-center">Filtra i risultati</h2>
        <form action="index.php" method="GET" class="d-flex flex-column w-50 m-auto my-5">
            <label class="mb-2">Filtra per voto</label>
            <select name="voto" class="mb-3">
                <option value="all" <?= $voto == "all" ? "selected" : "" ?>>Tutti</option>
                <option value="1" <?= $voto == "1" ? "selected" : "" ?>>1</option>
                <option value="2" <?= $voto == "2" ? "selected" : "" ?>>2</option>
                <option value="3" <?= $voto == "3" ? "selected" : "" ?>>3</option>
                <option value="4" <?= $voto == "4" ? "selected" : "" ?>>4</option>
                <option value="5" <?= $voto == "5" ? "selected" : "" ?>>5</option>
            </select>
            <label class="mb-2">Filtra per parcheggio disponibile</label>
            <select name="park" class="mb-3">
                <option value="all" <?= $park == "all" ? "selected" : "" ?>>Tutti</option>
                <option value="yes" <?= $park == "yes" ? "selected" : "" ?>>Si</option>
                <option value="no" <?= $park == "no" ? "selected" : "" ?>>No</option>
            </select>
            <button type="submit" class="btn btn-primary my-3">Filtra</button>
        </form>
        <hr class="mb-5">
        
        <!-- Impostazione filtri     -->

        <?php

        if ($park !== "all" || $voto !=="all") {
            foreach($hotels as $hotel){
            if ($park == "yes" && $voto == "all"){
                if ($hotel["parking"] == true){
                    $filteredArr[] = $hotel;
                }
            } else if ($park == "no" && $voto == "all"){
                if ($hotel["parking"] == false){
                    $filteredArr[] = $hotel;
                }
            } else if ($voto !== "all" && $park == "all"){
                if ($hotel['vote'] >= $voto ){
                    $filteredArr[] = $hotel;
                }
            } else if ($park !== "all" && $voto !=="all"){
                $park == "yes" ? $parkBool = true : $parkBool = false;
                if ($hotel['parking'] == $parkBool && $hotel['vote'] >= $voto){
                    $filteredArr[] = $hotel;
                }
            }
        }
        }

        // Stampa Hotels

        if ($park == "all" && $voto =="all") {
        foreach ($hotels as $hotel) {
            echo "<ul class=\"list-group\">";
                foreach ($hotel as $key => $value) {
                    if ($key == "parking") {
                        $value ? $park = "Si" : $park = "No";
                        echo "<li class=list-group-item> $key : $park </li>";
                    }else if ($key == "distance_to_center"){
                        $dist = $value . " Km";
                        echo "<li class=list-group-item> $key : $dist </li>";
                    }else {
                        echo "<li class=list-group-item> $key : $value </li>";
                    }

                }
            } 

            echo "</ul> <br>";
        } else {
            foreach ($filteredArr as $hotel) {
                echo "<ul class=\"list-group \">";
                    foreach ($hotel as $key => $value) {
                        if ($key == "parking") {
                            $value ? $parkStr = "Si" : $parkStr = "No";
                            echo "<li class=list-group-item> $key : $parkStr </li>";
                        } else if ($key == "distance_to_center"){
                            $dist = $value . " Km";
                            echo "<li class=list-group-item> $key : $dist </li>";
                        }else {
                            echo "<li class=list-group-item> $key : $value </li>";
                        }
    
                    }
                } 
    
                echo "</ul> <br>";
        }

        ?>

    </div>

</body>

</html>