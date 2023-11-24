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
                    <li class="nav-li"><a class="a" href="index.php">Kurzus CRUD</a></li>
                    <li class="nav-li"><a class="a" href="tananyag_letrehozas.php">Tananyag CRUD</a></li>';
                } else {
                    echo '
                    <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php">Kurzusaim</a></li>';
                }
            ?>
        </ul>
    </nav>
    <main>
        <p style="font-size: 40px; text-align: center; margin-bottom: 16px;">Profilom</p>
        <hr style="border-width: 1px; border-color: black; max-width: 500px;">

        <p style="font-size: 24px; text-align: center;">Én vagyok a(z) <?php echo $_SESSION["felhasznalo"]; ?></p>
        <br>
        <p style="font-size: 20px; text-align: center;">Munkamenet azonosítóm:</p>
        <p style="font-size: 16px; text-align: center;"><?php echo session_id();?></p>

        <form method="post" action="profil.php">
            <div style="text-align: center; margin-top: 75px;">
                <input type="submit" value="Kijelentkezés" name="logout-btn" class="logout-btn">
            </div>    
        </form>
    </main>
</body>
</html>