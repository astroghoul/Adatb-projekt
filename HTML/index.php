<?php
    session_start();

    include "../PHP/kurzusCUD.php";
    include "../PHP/tananyagletrehozas.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
    <link rel="stylesheet" href="../CSS/index.css">
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
                    <li class="nav-li"><a class="a" href="index.php" style="background-color: rgb(59, 25, 255);">Főoldal</a></li>';
                } else if (isset($_SESSION["felhasznalo"]) && ($_SESSION["szerepkor"] === "ROLE_ADMIN" || $_SESSION["szerepkor"] === "ROLE_TANAR")) {
                    echo '
                    <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>
                    <li class="nav-li"><a class="a" href="index.php" style="background-color: rgb(59, 25, 255);">Kurzus CRUD</a></li>
                    <li class="nav-li"><a class="a" href="tananyag_letrehozas.php">Tananyag CRUD</a></li>';
                } else {
                    echo '
                    <li class="nav-li"><a class="a" href="index.php">Főoldal</a></li>
                    <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>';
                }
            ?>
        </ul>
    </nav>

    <main>        
    <?php
        if(isset($_SESSION["felhasznalo"]) && ($_SESSION["szerepkor"] === "ROLE_ADMIN" || $_SESSION["szerepkor"] === "ROLE_TANAR")) {
            echo '<p style="font-size: 40px; text-align: center;">Kurzus létrehozása</p>';
                if (isset($sikeres_kurzusletrehozas) && $sikeres_kurzusletrehozas === true) {
                    echo "<p style='color: green; text-align: center; margin: 0;'>Sikeres kurzuslétrehozás!</p>";
                } else {
                    echo "<p style='color: red; text-align: center; margin: 0;'>" . $letrehozas_hiba . "</p>";
                }
            echo '
                <hr style="border-width: 1px; border-color: black; max-width: 500px;">
                <form class="kurzus-form" action="index.php" method="post">
                    <div class="grid-container">
                        <div class="grid-item">
                            <label for="kkod">Kurzuskód:</label>    
                        </div>
                        
                        <div class="grid-item">
                            <input type="text" name="kkod" placeholder="pl. PA-01" required>
                        </div>
            
                        <div class="grid-item">    
                            <label for="knev">Kurzus neve:</label>
                        </div>
                        
                        <div class="grid-item">
                            <input type="text" name="knev" placeholder="Programozás Alapjai" required>
                        </div>
            
                        <div class="grid-item">
                            <label for="felev">Félév:</label>
                        </div>
                        
                        <div class="grid-item">
                            <input type="number" name="felev" min="0" max="12" required>
                        </div>
            
                        <div class="grid-item">
                            <label for="kredit">Kredit:</label>
                        </div>
                        
                        <div class="grid-item">
                            <input type="number" name="kredit" min="0" max="6" required>
                        </div>
                    </div>
                    
                    <div style="text-align: center;">
                        <input type="submit" value="Létrehoz" class="kurzus-btn" name="kurzus-create-btn"> 
                    </div>
                </form>
            
                <hr style="border-width: 1px; border-color: black; max-width: 1400px;">';


            
            echo '
                <p style="font-size: 40px; text-align: center;">Kurzus módosítása</p>';
                    if (isset($sikeres_kurzusmodositas) && $sikeres_kurzusmodositas === true) {
                        echo "<p style='color: green; text-align: center; margin: 0;'>Sikeres kurzusmódosítás!</p>";
                    } else {
                        echo "<p style='color: green; text-align: center; margin: 0;'>" . $update_hiba . "</p>";
                    }
            echo '        
                <hr style="border-width: 1px; border-color: black; max-width: 500px;">
                
                <form class="kurzus-modification-form" action="index.php" method="post">
                    <div class="grid-container">    
                        <div class="grid-item">    
                            <label for="kurzus">Melyik kurzust szeretnéd módosítani?</label>
                        </div>
                        <div class="grid-item">
                            <select name="modositando-kurzus">';  
                                $connection = adatbazis_csatlakozas();
                                $query = "SELECT kkod, knev, felev, kredit FROM kurzus";
                                $result = $connection->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $kkod = $row["kkod"];
                                        $knev = $row["knev"];
                                        $felev = $row["felev"];
                                        $kredit = $row["kredit"];
                                        echo "<option value='$kkod'>" . $kkod . " | " . $knev . " | " . $felev . ". félév | " . $kredit . " kredit" . "</option>";
                                    }
                                } else {
                                    echo "Nincsenek még kurzusok!";
                                }
                echo '                    
                            </select>
                        </div>    

                        <div class="grid-item">
                            <label for="kkod_update">Új kurzuskód:</label>    
                        </div>
                        
                        <div class="grid-item">
                            <input type="text" name="kkod_update" placeholder="pl. PA-01" required>
                        </div>
            
                        <div class="grid-item">    
                            <label for="knev_update">Kurzus új neve:</label>
                        </div>
                        
                        <div class="grid-item">
                            <input type="text" name="knev_update" placeholder="Programozás Alapjai" required>
                        </div>
            
                        <div class="grid-item">
                            <label for="felev_update">Félév:</label>
                        </div>
                        
                        <div class="grid-item">
                            <input type="number" name="felev_update" min="0" max="12" required>
                        </div>
            
                        <div class="grid-item">
                            <label for="kredit_update">Kredit:</label>
                        </div>
                        
                        <div class="grid-item">
                            <input type="number" name="kredit_update" min="0" max="6" required>
                        </div>    
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <input type="submit" value="Módosít" class="kurzus-update-btn" name="kurzus-update-btn"> 
                    </div>
                </form>

                <hr style="border-width: 1px; border-color: black; max-width: 1400px;">';
                


            echo '
                <p style="font-size: 40px; text-align: center;">Kurzus törlése</p>'; 
                    if (isset($sikeres_kurzustorles) && $sikeres_kurzustorles === true) {
                        echo "<p style='color: green; text-align: center; margin: 0;'>Sikeres kurzustörlés!</p>";
                    }
            echo '        
                <hr style="border-width: 1px; border-color: black; max-width: 500px;">

                <form class="kurzus-delete-form" action="index.php" method="post">
                    <div class="grid-container">    
                        <div class="grid-item">    
                            <label for="kurzus">Melyik kurzust szeretnéd törölni?</label>
                        </div>
                        <div class="grid-item">
                            <select name="torlendo-kurzus">';   
                                $connection = adatbazis_csatlakozas();
                                $query = "SELECT kkod, knev, felev, kredit FROM kurzus";
                                $result = $connection->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $kkod = $row["kkod"];
                                        $knev = $row["knev"];
                                        $felev = $row["felev"];
                                        $kredit = $row["kredit"];
                                        echo "<option value='$kkod'>" . $kkod . " | " . $knev . " | " . $felev . ". félév | " . $kredit . " kredit" . "</option>";
                                    }
                                } else {
                                    echo "Nincsenek még kurzusok!";
                                }
            echo '                    
                            </select>
                        </div> 
                    </div>   
                        <div style="text-align: center;">
                            <input type="submit" value="Töröl" class="kurzus-del-btn" name="kurzus-del-btn"> 
                        </div>  
                </form>';
        }        

        if (!isset($_SESSION["felhasznalo"]) || (isset($_SESSION["felhasznalo"]) && $_SESSION["szerepkor"] === "ROLE_HALLGATO")) {
            echo '
                <p class="home" style="font-size: 42px; text-align: center; margin-bottom: 20px;">Üdvözlünk!</p>
                <hr style="width: 750px; border-color: black;">
                <div class="welcome-text">
                    <p style="margin: 0;">
                        Üdvözlünk a ... oldalán!
                    </p>
                    <p>
                        Ezen az oldalon különböző kurzusokat végezhetsz el a hozzá kapcsolódó tananyagok elsajátításával.
                        A kurzusokhoz a tanáraid fognak hozzárendelni és a tananyagokat is a megfelelő kurzusokon belül láthatod.
                        Ha felkeltette ez az érdeklődésedet, regisztrálj vagy amennyiben tag vagy már, jelentkezz be!
                    </p>
                </div>';
        }
    ?>
        </main>    
    <footer>

    </footer>
</body>
</html>