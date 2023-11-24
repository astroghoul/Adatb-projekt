<?php
    include_once "../PHP/db_functions.php";

    $connection = adatbazis_csatlakozas();
    
    $sikeres_kurzusletrehozas = false;
    $sikeres_kurzusmodositas = false;
    $sikeres_kurzustorles = false;
    $letrehozas_hiba = "";
    $update_hiba = "";

    // kurzus létrehozása
    if (isset($_POST["kurzus-create-btn"])) {
        $kkod = $_POST["kkod"];
        $knev = $_POST["knev"];
        $felev = $_POST["felev"];
        $kredit = $_POST["kredit"];

        // van-e ilyen kurzus már?
        $query = "SELECT * FROM kurzus WHERE kkod = '$kkod'";
        $result = $connection->query($query); 

        if ($result->num_rows > 0) {
            $letrehozas_hiba = "Ilyen kurzuskódú kurzus már létezik!";
        } else {
            $query = "INSERT INTO kurzus (kkod, knev, felev, kredit)
            VALUES ('$kkod', '$knev', '$felev', '$kredit')";
        
            $result = $connection->query($query);
            $sikeres_kurzusletrehozas = true;
        }
    }

    // kurzus módosítása
    if (isset($_POST["kurzus-update-btn"])) {
        $modositando_kkod = $_POST["modositando-kurzus"];
        $kkod = $_POST["kkod_update"];
        $knev = $_POST["knev_update"];
        $felev = $_POST["felev_update"];
        $kredit = $_POST["kredit_update"];

        // van-e ilyen kurzus már?
        $query = "SELECT * FROM kurzus WHERE kkod = '$kkod'";
        $result = $connection->query($query); 

        if ($result->num_rows > 0 && ($modositando_kkod !== $kkod)) {
            $update_hiba = "Ilyen kurzuskódú kurzus már létezik!";
        } else {
            $query = "UPDATE kurzus SET
                        kkod = '$kkod',
                        knev = '$knev',
                        felev = '$felev',
                        kredit = '$kredit'
                        WHERE kkod = '$modositando_kkod'";
        
            $result = $connection->query($query);
            $sikeres_kurzusmodositas = true;
        }
    }

    // kurzus törlése
    if (isset($_POST["kurzus-del-btn"])) {
        $torlendo_kkod = $_POST["torlendo-kurzus"];

        $query = "DELETE FROM kurzus WHERE kkod = '$torlendo_kkod'";
        $result = $connection->query($query);
        $sikeres_kurzustorles = true;
    }

    $connection->close();
?>