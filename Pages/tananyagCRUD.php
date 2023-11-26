<?php 
    session_start();

    include "../PHP/tananyagkezelo.php";

    if (!isset($_SESSION["felhasznalo"]) || ($_SESSION["szerepkor"] === "ROLE_HALLGATO")) {
        header("location: bejelentkezes.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tananyag CRUD</title>
    <link rel="stylesheet" href="../CSS/tananyagCRUD.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
<nav>
    <ul class="nav-ul">
        <li class="nav-li" style="float: left;"><a href="index.php" style="padding: 0;"><img src="../Images/Logo.jpg" class="logo-img" alt="Logo"></a></li>
        <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
        <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>
        <li class="nav-li"><a class="a" href="kurzusCRUD.php">Kurzus CRUD</a></li>
        <li class="nav-li"><a class="a" href="tananyagCRUD.php" style="background-color: rgb(59, 25, 255);">Tananyag CRUD</a></li>
    </ul>
</nav>

<main>
        <p style="font-size: 40px; text-align: center; margin-bottom: 0px;">Tananyag létrehozása</p>';
            <?php
                if (isset($sikeres_tananyagletrehozas) && $sikeres_tananyagletrehozas === true) {
                    echo "<p style='color: green; text-align: center; margin: 0;'>Sikeres tananyaglétrehozás!</p>";
                }
            ?>
        <hr style="border-width: 1px; border-color: black; max-width: 500px;">
        <form class="tananyag-form" action="tananyagCRUD.php" method="post">
            <div class="grid-container">
                <div class="grid-item">
                    <label for="nev">Név:</label>    
                </div>
                
                <div class="grid-item">
                    <input type="text" name="nev" placeholder="pl. Ismétlés" required>
                </div>
    
                <div class="grid-item">    
                    <label for="kurzusnev">Melyik kurzushoz?</label>
                </div>
                
                <div class="grid-item">
                    <select name="kurzusnev">';
                        <?php                       
                            $connection = adatbazis_csatlakozas();
                            $query = "SELECT kkod, knev FROM kurzus";
                            $result = $connection->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $kkod = $row["kkod"];
                                    $knev = $row["knev"];
                                    echo "<option value='$kkod'>" . $knev . "</option>";
                                }
                            } else {
                                echo "Nincsenek még kurzusok!";
                            }

                            $connection->close();
                        ?>    
                    </select>
                </div>

                <div class="grid-item">
                    <label for="tartalom">Tartalom:</label>
                </div>
                
                <div class="grid-item">
                    <textarea name="tartalom" rows="40" cols="60"></textarea>
                </div>
            </div>
            <div style="text-align: center;">
                <input type="submit" value="Hozzáad" class="tananyag-btn" name="tananyag-btn"> 
            </div>
        </form>
        
    <hr style="border-width: 1px; border-color: black; max-width: 1400px;">';

    <p style="font-size: 40px; text-align: center; margin-bottom: 0px;">Tananyag módosítása</p>';
    <?php 
        if (isset($sikeres_tananyagmodositas) && $sikeres_tananyagmodositas === true) {
            echo "<p style='color: green; text-align: center; margin-bottom: 16px;'>Sikeres tananyagmódosítás!</p>";
        }
    ?>
    <hr style="border-width: 1px; border-color: black; max-width: 500px; margin-top: 0px; margin-bottom: 0px;">
    
    <form class="tananyag-form" action="tananyagCRUD.php" method="post">
        <div class="grid-container">
            <div class="grid-item">    
                <label for="tananyagid">Melyik tananyagot szeretnéd módosítani?</label>
            </div>
            
            <div class="grid-item">
                <select name="tananyagid">
                    <?php 
                        $connection = adatbazis_csatlakozas();
                        $query = "SELECT tid, nev FROM tananyag";
                        $result = $connection->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $tid = $row["tid"];
                                $nev = $row["nev"];
                                echo "<option value='$tid'>" . $nev . "</option>";
                            }
                        } else {
                            echo "Nincsenek még tananyagok!";
                        }

                        $connection->close();
                    ?>
                </select>
            </div>    

            <div class="grid-item">
                <label for="ujnev">Új név:</label>    
            </div>
            
            <div class="grid-item">
                <input type="text" name="ujnev" placeholder="pl. Ismétlés" required>
            </div>
            
            <div class="grid-item">
                <label for="ujtartalom">Új tartalom:</label>
            </div>
                    
            <div class="grid-item">
                <textarea name="ujtartalom" rows="40" cols="60"></textarea>
            </div>
        </div>
        
        <div style="text-align: center;">
            <input type="submit" value="Módosítás" class="tananyag-mod-btn" name="tananyag-mod-btn">
        </div>
    </form>

</main>
    
</body>
</html>