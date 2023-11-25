<?php 
    session_start();
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
                    header("Location: kurzusaim.php");
                } else {
                    echo '
                    <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>
                    <li class="nav-li"><a class="a" href="index.php" style="background-color: rgb(59, 25, 255);">Főoldal</a></li>';
                }
            ?>
        </ul>
    </nav>
    <main>
        <?php 
            if (!isset($_SESSION["felhasznalo"])) {
                echo '
                    <p class="home" style="font-size: 42px; text-align: center; margin-bottom: 20px;">Üdvözlünk!</p>
                    <hr style="width: 750px; border-color: black;">
                    <div class="welcome-text">
                        <p style="margin: 0;">
                            Üdvözlünk itt!
                        </p>
                        <p>
                            Ezen az oldalon különböző kurzusokat végezhetsz el a hozzá kapcsolódó tananyagok elsajátításával.
                            A kurzusokhoz a tanáraid fognak hozzárendelni és a tananyagokat is a megfelelő kurzusokon belül láthatod.
                            Ha felkeltette ez az érdeklődésedet, regisztrálj vagy amennyiben tag vagy már, jelentkezz be!
                        </p>
                    </div>';
            } else if (isset($_SESSION["felhasznalo"]) && $_SESSION["szerepkor"] === "ROLE_HALLGATO") {
                echo '
                    <p class="home" style="font-size: 42px; text-align: center; margin-bottom: 20px;">Jó újra látni!</p>
                    <hr style="width: 750px; border-color: black;">
                    <div class="welcome-text">
                        <p>
                            A kurzusokat a "Kurzusaim" fül alatt, a tananyagokat pedig az adott kurzuson belül találod meg.  
                        </p>
                    </div>';
            }
        ?>    
    </main>
</body>
</html>