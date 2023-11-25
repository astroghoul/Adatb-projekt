<?php 
    session_start();

    include "../PHP/db_functions.php";

    if (!isset($_SESSION["felhasznalo"])) {
        header("location: bejelentkezes.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET['id'];?> kurzus oldala</title>
    <link rel="stylesheet" href="../CSS/kurzusoldal.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <nav>
        <ul class="nav-ul">
            <li class="nav-li" style="float: left;"><a href="index.php" style="padding: 0;"><img src="../Images/Logo.jpg" class="logo-img" alt="Logo"></a></li>
            <?php
                if (!isset($_SESSION["felhasznalo"])) {
                    echo '
                    <li class="nav-li"><a class="a" href="bejelentkezes.php">Bejelentkezés</a></li>
                    <li class="nav-li"><a class="a" href="regisztracio.php">Regisztáció</a></li>
                    <li class="nav-li"><a class="a" href="index.php">Főoldal</a></li>';
                } else if (isset($_SESSION["felhasznalo"]) && ($_SESSION["szerepkor"] === "ROLE_ADMIN" || $_SESSION["szerepkor"] === "ROLE_TANAR")) {
                    echo '
                    <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>
                    <li class="nav-li"><a class="a" href="index.php">Kurzus CRUD</a></li>
                    <li class="nav-li"><a class="a" href="tananyag_letrehozas.php">Tananyag CRUD</a></li>';
                } else {
                    echo '
                    <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>
                    <li class="nav-li"><a class="a" href="index.php">Főoldal</a></li>';
                }
            ?>
        </ul>
    </nav>

    <?php 
        $connection = adatbazis_csatlakozas();
        
        $id = $_GET['id'];
        $query = "SELECT kkod, knev, felev, kredit FROM kurzus WHERE kkod = '$id'";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $kkod = $row["kkod"];
        $knev = $row["knev"];
        $felev = $row["felev"];
        $kredit = $row["kredit"]
    ?>
    <main>
        <p class="home" style="font-size: 42px; text-align: center; margin-bottom: 20px;"><?php echo $kkod . ' - ' . $knev ?></p>
        <hr style="width: 750px; border-color: black;">
        <p class="home" style="font-size: 26px; text-align: center; margin-bottom: 20px;"><?php echo $felev . '. félév | ' . $kredit . ' kredit' ?></p>

        <div style="display: flex; justify-content: center;">
            <table>
                <thead>
                    <th>Tananyag neve</th>
                    <th>Létrehozó</th>
                    <th>Létrehozás dátuma</th>
                    <th>Utolsó megnyitás dátuma</th>
                </thead>
                <?php
                    $connection = adatbazis_csatlakozas();
                    $felhasznalo = $_SESSION["felhasznalo"];
                    $kkod = $_GET['id'];
                    $query = "SELECT * FROM tananyag WHERE kkod = '$kkod'";
                    $result = $connection->query($query);
                    
                    // a legutolsó megnyitás lekérdezése

                    while ($row = $result->fetch_assoc()) {
                        $tid = $row["tid"];
                        $nev = $row["nev"];
                        $letrehozo = $row["felhasznalonev"];
                        $letrehozas_datuma = $row["letrehozas_datuma"];

                        $query = "SELECT mikor FROM naplo 
                        WHERE felhasznalonev = '$felhasznalo' 
                        AND tid = '$tid' 
                        AND muvelet = 'megnyit' 
                        ORDER BY mikor DESC";
                        $mikor_result = $connection->query($query);
                        if ($mikor_result->num_rows === 0) {
                            $mikor = "Még nem nyitottad meg";
                        } else {
                            $sor = $mikor_result->fetch_assoc();
                            $mikor = $sor["mikor"];
                        }

                        $torles_gomb = '<td style="border: 0px;"><a href="kurzusoldal.php?id='. $kkod .'&deleteid='. $tid .'">Törlés</a></td>';

                        echo '
                        <tr>
                            <td>' . $nev . '</td>
                            <td>' . $letrehozo . '</td>
                            <td>' . $letrehozas_datuma . '</td>
                            <td>' . $mikor . '</td>
                            <td style="border: 0px;"><a href="tananyag.php?id='. $tid .'">Megnyitás</a></td>' . 
                                (($_SESSION["szerepkor"] === "ROLE_ADMIN" || $_SESSION["szerepkor"] == "ROLE_TANAR") ? $torles_gomb : '') .
                        '</tr>';
                    }

                    // tananyag törlése

                    if (isset($_GET["deleteid"])) {
                        $deleted_tid = $_GET["deleteid"];

                        $query = "DELETE FROM tananyag WHERE tid = '$deleted_tid'";
                        $result = $connection->query($query);
                        header("Location: kurzusoldal.php?id=" . $kkod);
                    }

                    // ha egy tananyag bezárásával jutottunk ide (GET), akkor naplózzuk a bezárást

                    if (isset($_GET["action"]) && $_GET["action"] === "close") {
                        $tid = $_GET["tid"];

                        $jelenlegi_datetime = date("Y-m-d H:i:s");

                        $query = "SELECT mikor FROM naplo 
                        WHERE muvelet = 'megnyit' 
                        AND felhasznalonev = '$felhasznalo' 
                        AND tid = '$tid'
                        ORDER BY mikor DESC";
                        $result = $connection->query($query);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $legutolso_megnyitas_to_sec = strtotime($row["mikor"]);
                            $legutolso_bezaras_to_sec = strtotime($jelenlegi_datetime);
                        } else {
                            $legutolso_megnyitas_to_sec = strtotime($jelenlegi_datetime);
                            $legutolso_bezaras_to_sec = strtotime($jelenlegi_datetime);
                        }

                        $query = "SELECT eltelt_ido FROM naplo 
                        WHERE muvelet = 'bezar' 
                        AND felhasznalonev = '$felhasznalo'
                        AND tid = '$tid'
                        ORDER BY eltelt_ido DESC";
                        $result = $connection->query($query);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $uj_eltelt_ido = $row["eltelt_ido"] + ($legutolso_bezaras_to_sec - $legutolso_megnyitas_to_sec);
                        } else {
                            $uj_eltelt_ido = 0 + ($legutolso_bezaras_to_sec - $legutolso_megnyitas_to_sec);
                        }

                        $query = "INSERT INTO naplo (felhasznalonev, tid, muvelet, mikor, eltelt_ido)
                        VALUES ('$felhasznalo', '$tid', 'bezar', '$jelenlegi_datetime', '$uj_eltelt_ido')";
                        $result = $connection->query($query);
                    }

                    // $query = "SELECT COUNT(DISTINCT tid) AS megnyitott_kurzusok FROM naplo WHERE"
                ?>
            </table>
        </div>
    </main>    
</body>
</html>