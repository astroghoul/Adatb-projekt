<?php
    include "../PHP/db_functions.php";

    session_start();
    if (!isset($_SESSION["felhasznalo"])) {
        header("location: bejelentkezes.php");
    }

    if (isset($_POST["logout-btn"])) {
        kijelentkeztet();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilom</title>
    <link rel="stylesheet" href="../CSS/profil.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <nav>
        <ul class="nav-ul">
            <li class="nav-li" style="float: left;"><a href="index.php" style="padding: 0;"><img src="../Images/Logo.jpg" class="logo-img" alt="Logo"></a></li>
            <?php
                if (isset($_SESSION["felhasznalo"]) && ($_SESSION["szerepkor"] === "ROLE_ADMIN" || $_SESSION["szerepkor"] === "ROLE_TANAR")) {
                    echo '
                    <li class="nav-li"><a class="a" href="profil.php" style="background-color: rgb(59, 25, 255);">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>
                    <li class="nav-li"><a class="a" href="kurzusCRUD.php">Kurzus CRUD</a></li>
                    <li class="nav-li"><a class="a" href="tananyagCRUD.php">Tananyag CRUD</a></li>';
                } else {
                    echo '
                    <li class="nav-li"><a class="a" href="profil.php" style="background-color: rgb(59, 25, 255);">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>
                    <li class="nav-li"><a class="a" href="index.php">Főoldal</a></li>';
                }
            ?>
        </ul>
    </nav>
    <main>
        <p style="font-size: 40px; text-align: center; margin-bottom: 16px;">Profilom</p>
        <hr style="border-width: 1px; border-color: black; max-width: 500px;">
        
        <?php 
            // felhasználó adatainak lekérése

            $connection = adatbazis_csatlakozas();
            
            $felhasznalo = $_SESSION["felhasznalo"];
            $query = "SELECT email, vezeteknev, keresztnev FROM felhasznalo WHERE felhasznalonev = '$felhasznalo'";
            $result = $connection->query($query);
            $row = $result->fetch_assoc();
            $email = $row["email"];
            $vezeteknev = $row["vezeteknev"];
            $keresztnev = $row["keresztnev"];
        ?>

        <div class="grid-container">
            <div class="grid-item">
                Felhasználónév:    
            </div>
            
            <div class="grid-item">
                <?php echo $felhasznalo; ?>
            </div>
            
            <div class="grid-item">
                Email:
            </div>

            <div class="grid-item">
                <?php echo $email; ?>
            </div>

            <div class="grid-item">    
                Vezetéknév:
            </div>
            
            <div class="grid-item">
                <?php echo $vezeteknev; ?>
            </div>

            <div class="grid-item">
                Keresztnév:
            </div>
            
            <div class="grid-item">
                <?php echo $keresztnev; ?>
            </div>
        </div>
        <br>
        <form method="post" action="profil.php">
            <div style="text-align: center;">
                <input type="submit" value="Kijelentkezés" name="logout-btn" class="logout-btn">
            </div>    
        </form>
    </main>
</body>
</html>