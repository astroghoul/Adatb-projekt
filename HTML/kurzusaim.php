<?php
    include "../PHP/db_functions.php";
    session_start();

    if (!isset($_SESSION["felhasznalo"])) {
        header("location: bejelentkezes.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurzusaim</title>
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/kurzusaim.css">
</head>
<body>
    <nav>
        <ul class="nav-ul">
            <li class="nav-li" style="float: left;"><a href="index.php" style="padding: 0;"><img src="../Images/Logo.jpg" class="logo-img" alt="Logo"></a></li>
            <?php
                if (isset($_SESSION["felhasznalo"]) && ($_SESSION["szerepkor"] === "ROLE_ADMIN" || $_SESSION["szerepkor"] === "ROLE_TANAR")) {
                    echo '
                    <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php" style="background-color: rgb(59, 25, 255);">Kurzusaim</a></li>
                    <li class="nav-li"><a class="a" href="index.php"">Kurzus CRUD</a></li>
                    <li class="nav-li"><a class="a" href="tananyag_letrehozas.php">Tananyag CRUD</a></li>';
                } else {
                    echo '
                    <li class="nav-li"><a class="a" href="index.php">Főoldal</a></li>
                    <li class="nav-li"><a class="a" href="profil.php">Profil</a></li>
                    <li class="nav-li"><a class="a" href="kurzusaim.php" style="background-color: rgb(59, 25, 255);>Kurzusaim</a></li>';
                }
            ?>
        </ul>
    </nav>
    <main>
        <p class="kurzus_all" style="font-size: 42px; text-align: center; margin-bottom: 20px;">Kurzusok</p>
        <hr style="width: 750px; border-color: black; margin-bottom: 50px;">

        <div style="display: flex; justify-content: center;">
            <table>
                <thead>
                    <th>Kurzuskód</th>
                    <th>Kurzusnév</th>
                    <th>Félév</th>
                    <th>Kredit</th>
                </thead>
                <?php
                    $connection = adatbazis_csatlakozas();
                    $query = "SELECT * FROM kurzus";
                    $result = $connection->query($query);
                    if ($result->num_rows > 0) {
                        echo '';
                    }
                    while ($row = $result->fetch_assoc()) {
                        $kkod = $row["kkod"];
                        $knev = $row["knev"];
                        $felev = $row["felev"];
                        $kredit = $row["kredit"];
                        echo '
                        <tr>
                            <td>' . $kkod . '</td>
                            <td>' . $knev . '</td>
                            <td>' . $felev . '</td>
                            <td>' . $kredit . '</td>
                            <td style="border: 0px;"><form method="post"><input type="submit" class="open-btn" name=' . $kkod . ' value="Megnyitás"></form></td>';
                        '</tr>';
                    }
                ?>
            </table>
        </div>
    </main>
</body>
</html>