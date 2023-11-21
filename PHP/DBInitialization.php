<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adatbázis inicializáló</title>
</head>
<body>
    
    <?php 

        // kapcsolat létrehozása a MySQL szerverrel

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $connection = new mysqli($servername, $username, $password);
        if ($connection->connect_error) {
            die("csatlakozási hiba: " . $connection->connect_error);
        }

        // adatbázis létrehozása

        $query = "CREATE DATABASE tananyagkezelo";
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Adatbázis sikeresen létrehozva<br>";
        } else {
            echo "HIBA az adatbázis létrehozása során: " . $connection->error;
        }

        $connection->close();
        
        // felhasznalok tábla létrehozása

        echo "<br>FELHASZNALO TÁBLA<br>";

        $dbname="tananyagkezelo";
        $connection=new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
            die("csatlakozási hiba: " . $connection->connect_error);
        }

        $query = "CREATE TABLE felhasznalo (
            felhasznalonev VARCHAR(100) NOT NULL PRIMARY KEY,
            email VARCHAR(150) NOT NULL UNIQUE,
            jelszo VARCHAR(150) NOT NULL,
            vezeteknev VARCHAR(100) NOT NULL,
            keresztnev VARCHAR(100) NOT NULL,
            szerepkor VARCHAR(30) NOT NULL,
            online BOOLEAN NOT NULL
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'felhasznalo' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'felhasznalo' tábla létrehozása során: " . $connection->error;
        }

        $query = "INSERT INTO felhasznalo (felhasznalonev, email, jelszo, vezeteknev, keresztnev, szerepkor, online)
            VALUES 
            ('b_kev03', 'b_kev03@gmail.com', '" . password_hash("kevin123", PASSWORD_DEFAULT) . "', 'Bak', 'Kevin', 'ROLE_ADMIN,', 'FALSE'),
            ('kovacsmiklos03', 'kovmik03@gmail.com', '" . password_hash("kovmik123", PASSWORD_DEFAULT) . "', 'Kovács', 'Miklós', 'ROLE_HALLGATO,', 'FALSE'),
            ('kisbela85', 'kbela85@gmail.com', '" . password_hash("kbela1985", PASSWORD_DEFAULT) . "', 'Kis', 'Béla', 'ROLE_TANAR,', 'FALSE'),
            ('admin', 'admin@admin.com', '" . password_hash("admin", PASSWORD_DEFAULT) . "', 'ADMIN', 'ISZTRÁTOR', 'ROLE_ADMIN,', 'FALSE')
            ";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel a 'felhasznalo' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása a 'felhasználo' táblába: " . $connection->error;
        } 
        
        /*
        // ADMIN, TANAR, HALLGATO táblák létrehozása
        
        // ADMIN

        echo "<br>ADMIN TÁBLA<br>";

        $query = "CREATE TABLE admin (
            felhasznalonev VARCHAR(100) NOT NULL PRIMARY KEY,
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'admin' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA az 'admin' tábla létrehozása során: " . $connection->error;
        }

        $query = "INSERT INTO admin (felhasznalonev)
            VALUES 
            ('b_kev03'),
            ('admin')
            ";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel az 'admin' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása az 'admin' táblába: " . $connection->error;
        } 

        // TANAR

        echo "<br>TANAR TÁBLA<br>";

        $query = "CREATE TABLE tanar (
            felhasznalonev VARCHAR(100) NOT NULL PRIMARY KEY,
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'tanar' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'tanar' tábla létrehozása során: " . $connection->error;
        }

        $query = "INSERT INTO tanar (felhasznalonev)
            VALUES 
            ('kisbela85')
            ";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel a 'tanar' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása a 'tanar' táblába: " . $connection->error;
        } 

        // HALLGATO

        echo "<br>HALLGATO TÁBLA<br>";

        $query = "CREATE TABLE hallgato (
            felhasznalonev VARCHAR(100) NOT NULL PRIMARY KEY,
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'hallgato' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'hallgato' tábla létrehozása során: " . $connection->error;
        }

        $query = "INSERT INTO hallgato (felhasznalonev)
            VALUES
            ('kovacsmiklos03')
            ";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel a 'hallgato' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása a 'hallgato' táblába: " . $connection->error;
        }
        */
        
        // KURZUS tábla

        echo "<br>KURZUS TÁBLA<br>";

        $query = "CREATE TABLE kurzus (
            kkod VARCHAR(100) NOT NULL PRIMARY KEY,
            knev VARCHAR(150) NOT NULL,
            felev INT NOT NULL,
            kredit INT NOT NULL
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'kurzus' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'kurzus' tábla létrehozása során: " . $connection->error;
        }

        // TANANYAG tábla

        echo "<br>TANANYAG TÁBLA<br>";

        $query = "CREATE TABLE tananyag (
            tid INT NOT NULL PRIMARY KEY,
            nev VARCHAR(150) NOT NULL,
            letrehozas_datuma DATETIME NOT NULL,
            kkod VARCHAR(100) NOT NULL,
            felhasznalonev VARCHAR(100) NOT NULL,
            FOREIGN KEY (kkod) REFERENCES kurzus(kkod) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE
            )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'tananyag' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'tananyag' tábla létrehozása során: " . $connection->error;
        }

        // NAPLÓ tábla

        echo "<br>NAPLO TÁBLA<br>";

        $query = "CREATE TABLE naplo (
            nid INT NOT NULL PRIMARY KEY,
            felhasznalonev VARCHAR(100) NOT NULL,
            tid INT NOT NULL,
            kkod VARCHAR(100) NOT NULL,
            muvelet VARCHAR(100) NOT NULL,
            mikor DATETIME NOT NULL,
            eltelt_ido INT,
            FOREIGN KEY (kkod) REFERENCES kurzus(kkod) ON DELETE CASCADE,
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (tid) REFERENCES tananyag(tid) ON DELETE CASCADE ON UPDATE CASCADE
            )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'naplo' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'naplo' tábla létrehozása során: " . $connection->error;
        }

        // TANÁROK_KURZUSAI tábla

        echo "<br>TANAROK_KURZUSAI tábla<br>";

        $query = "CREATE TABLE tanarok_kurzusai (
            felhasznalonev VARCHAR(100) NOT NULL,
            kkod VARCHAR(100) NOT NULL, 
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (kkod) REFERENCES kurzus(kkod) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'tanarok_kurzusai' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'tanarok_kurzusai' tábla létrehozása során: " . $connection->error;
        }

        // HALLGATÓK_KURZUSAI tábla

        echo "<br>HALLGATOK_KURZUSAI tábla<br>";

        $query = "CREATE TABLE hallgatok_kurzusai (
            felhasznalonev VARCHAR(100) NOT NULL,
            kkod VARCHAR(100) NOT NULL, 
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (kkod) REFERENCES kurzus(kkod) ON DELETE CASCADE ON UPDATE CASCADE
        )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'hallgatok_kurzusai' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'hallgatok_kurzusai' tábla létrehozása során: " . $connection->error;
        }
        
        $connection->close();
    ?>
</body>
</html>