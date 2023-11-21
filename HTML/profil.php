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
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/profil.css">
</head>
<body>
    <nav>
        <ul class="nav-ul">
            <li class="nav-li" style="float: left;"><a href="index.php" style="padding: 0;"><img src="../Images/Logo.jpg" class="logo-img" alt="Logo"></a></li>
            <li class="nav-li" style="background-color: rgb(59, 25, 255);"><a class="a" href="profil.php">Profil</a></li>
            <?php
            if (!isset($_SESSION["felhasznalo"])) {
                echo '<li class="nav-li"><a class="a" href="index.php">Főoldal</a></li>';
            } else {
                echo '<li class="nav-li"><a class="a" href="index.php">Kurzusok</a></li>';
            }
            ?>
        </ul>
    </nav>
    <p>Ez a Profilom</p>
    <br>
    <p><?php echo session_id();?></p>

    <form method="post" action="profil.php">
        <input type="submit" value="Kijelentkezés" name="logout-btn">
    </form>
</body>
</html>