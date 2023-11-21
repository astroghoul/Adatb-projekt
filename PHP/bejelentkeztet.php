<?php
    include "db_functions.php";

    $connection = adatbazis_csatlakozas();

    $hibak = [];
    $successful = false;

    if (isset($_POST["login-btn"])) {
        $felhasznalonev = trim($_POST["uname"]);
        $jelszo = trim($_POST["pw"]);

        // megadta-e / nem üres-e?

        if (!isset($_POST["uname"]) || trim($_POST["uname"]) === "") {
            $hibak[] = "Felhasználónév megadása kötelező!";
        }

        if (!isset($_POST["pw"]) || trim($_POST["pw"]) === "") {
            $hibak[] = "A jelszó mezőt ki kell tölteni!";
        }

        // ha helyes

        $query = "SELECT * FROM felhasznalo WHERE felhasznalonev = '$felhasznalonev'";
        $result = $connection->query($query);
        
        if (!empty($felhasznalonev) && !empty($jelszo)) {
            $row = $result->fetch_assoc();
            if ($result->num_rows == 0) {
                $hibak[] = "Nincs ilyen felhasználó!";
            } else {
                $hibak[] = "Rossz jelszó!";
            }
            
            if (isset($row["felhasznalonev"]) && $felhasznalonev === $row["felhasznalonev"] && password_verify($jelszo, $row["jelszo"])) {
                session_start();
                $_SESSION["felhasznalo"] = $row["felhasznalonev"];
                $query_update = "UPDATE felhasznalo
                                SET online = TRUE
                                WHERE felhasznalonev = '$felhasznalonev'";
                $connection->query($query_update);
                header("location: profil.php");
            }

        }

        $successful = false;
        
    }

    $connection->close();
?>