<?php
    include_once "db_functions.php";

    $connection = adatbazis_csatlakozas();
    $sikeres_tananyagletrehozas = false;
    $sikeres_tananyagmodositas = false;

    if (isset($_POST["tananyag-btn"])) {
        $nev = $_POST["nev"];
        $kkod = $_POST["kurzusnev"];
        $tartalom = $_POST["tartalom"];
        $current_date = date("Y-m-d");
        $current_user = $_SESSION["felhasznalo"];

        $query = "INSERT INTO `tananyag`(tid, nev, letrehozas_datuma, kkod, tartalom, felhasznalonev)
        VALUES (NULL, '$nev', '$current_date', '$kkod', '$tartalom', '$current_user')";
    
        $result = $connection->query($query);
        $sikeres_tananyagletrehozas = true;
    }

    if (isset($_POST["tananyag-mod-btn"])) {
        $ujnev = $_POST["ujnev"];
        $modositando_tid = $_POST["tananyagid"];
        $ujtartalom = $_POST["ujtartalom"];

        $current_date = date("Y-m-d");
        $current_user = $_SESSION["felhasznalo"];

        $query = "UPDATE tananyag 
        SET nev = '$ujnev',
            letrehozas_datuma = '$current_date',
            tartalom = '$ujtartalom',
            felhasznalonev = '$current_user'
        WHERE tid = '$modositando_tid'";

        $result = $connection->query($query);
        $sikeres_tananyagmodositas = true;
    }
    
    $connection->close();
?>