<?php
    include "../PHP/bejelentkeztet.php";

    session_start();
    if (isset($_SESSION["felhasznalo"])) {
        header("location: profil.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="../CSS/bejelentkezes.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <nav>
        <ul class="nav-ul">
            <li class="nav-li" style="float: left;"><a href="index.php" style="padding: 0;"><img src="../Images/Logo.jpg" class="logo-img" alt="Logo"></a></li>
            <li class="nav-li" style="background-color: rgb(59, 25, 255);"><a class="a" href="bejelentkezes.php">Bejelentkezés</a></li>
            <li class="nav-li"><a class="a" href="regisztracio.php">Regisztáció</a></li>
            <li class="nav-li"><a class="a" href="index.php">Főoldal</a></li>
        </ul>
    </nav>

    <main>
        <div id="log-text">Bejelentkezés</div>
        <hr>
        <form class="log-form" action="bejelentkezes.php" method="post">
            <fieldset class="log-fieldset">
                <div class="grid-container">
                    <div class="grid-item">
                        <label for="uname">Felhasználónév:</label>    
                    </div>
                    
                    <div class="grid-item">
                        <input type="text" name="uname" placeholder="kovacsmiklos05" required>
                    </div>

                    <div class="grid-item">
                        <label for="pw">Jelszó:</label>
                    </div>
                    
                    <div class="grid-item">
                        <input type="password" name="pw" required>
                    </div>
                </div>      
            </fieldset>
            
            <?php 
                if ($successful === true) {
                    echo "<p>Sikeres bejelentkezés!</p>";
                } else {
                    foreach ($hibak as $hiba) {
                        echo "<p style='color: red; text-align: center; margin: 0;'>" . $hiba . "</p>";
                    }
                }
            ?>

            <input type="submit" value="Bejelentkezés" class="login-btn" name="login-btn">
        </form>

    </main>

    <footer>

    </footer>
</body>
</html>