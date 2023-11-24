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
            ('b_kev03', 'b_kev03@gmail.com', '" . password_hash("kevin123", PASSWORD_DEFAULT) . "', 'Bak', 'Kevin', 'ROLE_ADMIN', 'FALSE'),
            ('kovacsmiklos03', 'kovmik03@gmail.com', '" . password_hash("kovmik123", PASSWORD_DEFAULT) . "', 'Kovács', 'Miklós', 'ROLE_HALLGATO', 'FALSE'),
            ('feklaj03', 'feklaj03@gmail.com', '" . password_hash("feklaj123", PASSWORD_DEFAULT) . "', 'Fekete', 'Lajos', 'ROLE_HALLGATO', 'FALSE'),
            ('kisbela85', 'kbela85@gmail.com', '" . password_hash("kbela1985", PASSWORD_DEFAULT) . "', 'Kis', 'Béla', 'ROLE_TANAR', 'FALSE'),
            ('admin', 'admin@admin.com', '" . password_hash("admin", PASSWORD_DEFAULT) . "', 'ADMIN', 'ISZTRÁTOR', 'ROLE_ADMIN', 'FALSE')
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

        $query = "INSERT INTO `kurzus` (`kkod`, `knev`, `felev`, `kredit`) 
        VALUES ('PROG1-01', 'Programozás I.', '2', '3'),
        ('KALK-01', 'Kalkulus I.', '1', '3'),
        ('OPKUT-01', 'Operációkutatás', '2', '2'),
        ('ADATB-01', 'Adatbázisok', '2', '3'),
        ('PROGALAP-01', 'Programozás Alapjai', '1', '3')
        ";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel a 'kurzus' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása a 'kurzus' táblába: " . $connection->error;
        } 

        // TANANYAG tábla

        echo "<br>TANANYAG TÁBLA<br>";

        $query = "CREATE TABLE tananyag (
            tid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nev VARCHAR(150) NOT NULL,
            letrehozas_datuma DATE NOT NULL,
            kkod VARCHAR(100) NOT NULL,
            tartalom VARCHAR(65535) NOT NULL,
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

        $jelenlegi_datum = date("Y-m-d");
        $query = "INSERT INTO `tananyag` (`tid`, `nev`, `letrehozas_datuma`, `kkod`, `tartalom`, `felhasznalonev`) VALUES (NULL, 'Ismétlés', '2023-11-21', 'KALK-01', '1+1 az mindig 2', 'kisbela85'),
        (NULL, 'A C nyelv', '$jelenlegi_datum', 'PROGALAP-01', 'A main függvény a program belépési pontja', 'kisbela85')";
        
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Sikeres adatfelvétel a 'tananyag' táblába<br>";
        } else {
            echo "HIBA! Nem sikerült a rekordok beszúrása a 'tananyag' táblába: " . $connection->error;
        }

        // NAPLÓ tábla

        echo "<br>NAPLO TÁBLA<br>";

        $query = "CREATE TABLE naplo (
            nid INT NOT NULL PRIMARY KEY,
            felhasznalonev VARCHAR(100) NOT NULL,
            tid INT NOT NULL,
            muvelet VARCHAR(100) NOT NULL,
            mikor DATETIME NOT NULL,
            eltelt_ido INT,
            FOREIGN KEY (felhasznalonev) REFERENCES felhasznalo(felhasznalonev) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (tid) REFERENCES tananyag(tid) ON DELETE CASCADE ON UPDATE CASCADE
            )";

        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "'naplo' tábla sikeresen létrehozva<br>";
        } else {
            echo "HIBA a 'naplo' tábla létrehozása során: " . $connection->error;
        }

        /*
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
        */
        
        $connection->close();
    ?>
</body>
</html>