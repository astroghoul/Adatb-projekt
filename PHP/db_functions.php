<?php

    // connection

    function adatbazis_csatlakozas() {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'tananyagkezelo';
        $connection = new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
            die("csatlakozási hiba: " . $connection->connect_error);
        }

        return $connection;
    }

    ///////////////////////////

    function regisztral($felhnev, $email, $jelszo, $vezeteknev, $keresztnev, $szerepkor, $online) {
        $connection = adatbazis_csatlakozas();
        
        if ($connection) {
            $kodolt_jelszo = password_hash($jelszo, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare($connection, "INSERT INTO felhasznalo(felhasznalonev, email, jelszo, vezeteknev, keresztnev, szerepkor, online)
            VALUES (?, ?, ?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param($stmt,"ssssssd", $felhnev, $email, $kodolt_jelszo, $vezeteknev, $keresztnev, $szerepkor, $online);
            
            mysqli_stmt_execute($stmt);
            $connection->close();
            return true;
        }

        return false;
    }

    function kijelentkeztet() {
        $felhasznalonev = $_SESSION["felhasznalo"];
        $connection = adatbazis_csatlakozas();

        session_start();
        session_unset();
        session_destroy();

        $query_update = "UPDATE felhasznalo
                            SET online = 0
                            WHERE felhasznalonev = '$felhasznalonev'";
        $connection->query($query_update);

        header("location: bejelentkezes.php");
    }
?>