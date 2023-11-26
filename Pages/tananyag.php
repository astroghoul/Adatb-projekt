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
    <title>Tananyag</title>
    <link rel="stylesheet" href="../CSS/tananyag.css">
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
                    <li class="nav-li"><a class="a" href="kurzusCRUD.php">Kurzus CRUD</a></li>
                    <li class="nav-li"><a class="a" href="tananyagCRUD.php">Tananyag CRUD</a></li>';
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
        
        $felhasznalo = $_SESSION["felhasznalo"];
        $jelenlegi_tid = $_GET["id"];
        $query = "SELECT nev, kkod, tartalom FROM tananyag WHERE tid = '$jelenlegi_tid'";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $tananyag_neve = $row["nev"];
        $tartalom = $row["tartalom"];
        $kkod = $row["kkod"];
    ?>

    <main>
        <p class="kurzus_all" style="font-size: 42px; text-align: center; margin-bottom: 20px;"><?php echo $tananyag_neve; ?></p>
        <hr style="width: 750px; border-color: black; margin-bottom: 50px;">
        
        <div style="background-color: rgb(148, 148, 255); box-shadow: 0px 0px 20px; max-width: 500px; margin: auto; padding: 20px 0px 20px 0px; display: flex; justify-content: center;">
            <p class="kurzus_all" style="font-size: 18px; text-align: center; max-width: 500px; margin-left: 20px; margin-right: 20px;"><?php echo $tartalom; ?></p>
        </div>
        <div style="text-align: center; margin-top: 42px;">
            <?php     
                $query = "SELECT * FROM tananyag WHERE tid < '$jelenlegi_tid' AND kkod ='$kkod'";
                $result = $connection->query($query);
                if ($row = $result->fetch_assoc()) {
                    $kovetkezo_tid = $row["tid"];
                    echo '<a href="tananyag.php?prev_id=' . $jelenlegi_tid . '&action=next&id=' . $kovetkezo_tid . '" style="padding: 32px;">Előző tananyag</a>';
                    $tananyag_neve = $row["nev"];
                    $tartalom = $row["tartalom"];
                    $kkod = $row["kkod"];
                }
            ?>    
            <a href="kurzusoldal.php?action=close&id=<?php echo $kkod;?>&tid=<?php echo $jelenlegi_tid;?>" style="padding: 32px;">Bezár</a>
            <?php 
                $query = "SELECT * FROM tananyag WHERE tid > '$jelenlegi_tid' AND kkod ='$kkod'";
                $result = $connection->query($query);
                if ($row = $result->fetch_assoc()) {
                    $kovetkezo_tid = $row["tid"];
                    echo '<a href="tananyag.php?prev_id=' . $jelenlegi_tid . '&action=next&id=' . $kovetkezo_tid . '" style="padding: 32px;">Következő tananyag</a>';
                    $tananyag_neve = $row["nev"];
                    $tartalom = $row["tartalom"];
                    $kkod = $row["kkod"];
                }

                if (isset($_GET["action"]) && $_GET["action"] === "next") {
                    // itt prev_id, mivel az URL-ben elmentjük az előző tananyag tid-jét 
                    $prev_tid = $_GET["prev_id"];
                    $tid = $_GET["id"];

                        $query = "SELECT mikor FROM naplo 
                        WHERE muvelet = 'megnyit' 
                        AND felhasznalonev = '$felhasznalo' 
                        AND tid = '$prev_tid'
                        ORDER BY mikor DESC";
                        $result = $connection->query($query);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $legutolso_megnyitas_to_sec = strtotime($row["mikor"]);
                            $legutolso_bezaras_to_sec = strtotime(date("Y-m-d H:i:s"));
                        } else {
                            $legutolso_megnyitas_to_sec = strtotime(date("Y-m-d H:i:s"));
                            $legutolso_bezaras_to_sec = strtotime(date("Y-m-d H:i:s"));
                        }
                        
                        // az új eltelt idő kiszámítása (a legutolsó bezárásnál levő eltelt idő attribútumhoz hozzáadjuk a legutóbbi megnyitás és bezárás közti időt)

                        $query = "SELECT eltelt_ido FROM naplo 
                        WHERE muvelet = 'bezar' 
                        AND felhasznalonev = '$felhasznalo'
                        AND tid = '$prev_tid'
                        ORDER BY eltelt_ido DESC";
                        $result = $connection->query($query);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $uj_eltelt_ido = $row["eltelt_ido"] + ($legutolso_bezaras_to_sec - $legutolso_megnyitas_to_sec);
                        } else {
                            $uj_eltelt_ido = 0 + ($legutolso_bezaras_to_sec - $legutolso_megnyitas_to_sec);
                        }

                        $jelenlegi_datetime = date("Y-m-d H:i:s");
                        $query = "INSERT INTO naplo (felhasznalonev, tid, muvelet, mikor, eltelt_ido)
                        VALUES ('$felhasznalo', '$prev_tid', 'bezar', '$jelenlegi_datetime', '$uj_eltelt_ido')";
                        $result = $connection->query($query);

                        $jelenlegi_datetime = date("Y-m-d H:i:s");
                        $query = "INSERT INTO naplo (felhasznalonev, tid, muvelet, mikor, eltelt_ido)
                        VALUES ('$felhasznalo', '$prev_tid', 'lapoz', '$jelenlegi_datetime', 0)";
                        $result = $connection->query($query);

                }

                if (isset($_GET["id"])) {
                    $tid = $_GET["id"];
                    $jelenlegi_datetime = date('Y-m-d H:i:s');
                    $query_insert = "INSERT INTO naplo (felhasznalonev, tid, muvelet, mikor, eltelt_ido)
                    VALUES ('$felhasznalo', '$tid', 'megnyit', '$jelenlegi_datetime', 0)";
                    $result_insert = $connection->query($query_insert);
                }
                
                $connection->close();
            ?>
        </div>        
    </main>
    
</body>
</html>