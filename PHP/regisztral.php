<?php
    include "db_functions.php";

    $connection = adatbazis_csatlakozas();

    $hibak = [];
    $successful = false;
    
    if (isset($_POST["register-btn"])) {
        
        // mindent megadott-e?

        if (!isset($_POST["uname"]) || trim($_POST["uname"]) === "") {
            $hibak[] = "Felhasználónév megadása kötelező!";
        }
        
        if (!isset($_POST["pw"]) || trim($_POST["pw"]) === "" || !isset($_POST["pw-again"]) || trim($_POST["pw-again"] === "")) {
            $hibak[] = "A jelszó és a jelszó másodszori megadása kötelező!";
        }

        if (!isset($_POST["lastname"]) || trim($_POST["lastname"]) === "") {
            $hibak[] = "Vezetéknév megadása kötelező!";
        }

        if (!isset($_POST["firstname"]) || trim($_POST["firstname"]) === "") {
            $hibak[] = "Keresztnév megadása kötelező!";
        }

        if (!isset($_POST["email"]) || trim($_POST["email"]) === "") {
            $hibak[] = "E-mail cím megadása kötelező!";
        }

        // változók

        $fnev = trim($_POST["uname"]);
        $email = trim($_POST["email"]);
        $jelszo = trim($_POST["pw"]);
        $jelszoujra = trim($_POST["pw-again"]);
        $vezeteknev = trim($_POST["lastname"]);
        $keresztnev = trim($_POST["firstname"]);

        // felhasználónév - check

        $query = "SELECT felhasznalonev FROM felhasznalo WHERE felhasznalonev = '$fnev'";
        $result = $connection->query($query);

        if (strlen($fnev) < 4) {
            $hibak[] = "A felhasználónévnek 4 karakternél hosszabbnak kell legyen!";
        } else if (strlen($fnev) > 100) {
            $hibak[] = "A felhasználónév maximális hossza 100 karakter!";
        } else if ($result->num_rows > 0) {
            $hibak[] = "Ezzel a felhasználónévvel már regisztráltak!";
        }

        // email - check

        $query = "SELECT email FROM felhasznalo WHERE email = '$email'";
        $result = $connection->query($query);

        $array = explode("@", $email);
        if (count($array) != 2 || count(explode(".", $array[1])) < 2) {
            $hibak[] = "Nem megfelelő e-mail formátum!";
        } else if ($result->num_rows > 0) {
            $hibak[] = "Ezzel az e-mail címmel már regisztráltak!";
        }

        // jelszó - check

        if (strlen($jelszo < 8)) {
            $hibak[] = "A jelszónak legalább 8 karakterből kell állnia!";
        } else if (strlen($jelszo) > 150) {
            $hibak[] = "A jelszó maximális hossza 150 karakter!";
        } else if (strtolower($jelszo) === $jelszo) {
            $hibak[] = "A jelszónak tartalmaznia kell nagybetűt!";
        }

        // jelszó és jelszó-újra - check
        
        if ($jelszo !== $jelszoujra) {
            $hibak[] = "A két jelszó nem egyezik!";
        }

        // sikeres-e a regisztráció?

        if (empty($hibak)) {
            regisztral($fnev, $email, $jelszo, $vezeteknev, $keresztnev, "ROLE_HALLGATO", false);
            $successful = true;
            header("Location: bejelentkezes.php");
        } else {
            $successful = false;
        }
    }
    
    $connection->close();
?>