<?php 
    include "../PHP/regisztral.php";
 
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
    <title>Regisztráció</title>
    <link rel="stylesheet" href="../CSS/regisztracio.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <nav>
        <ul class="nav-ul">
            <li class="nav-li" style="float: left;"><a href="index.php" style="padding: 0;"><img src="../Images/Logo.jpg" class="logo-img" alt="Logo"></a></li>
            <li class="nav-li"><a class="a" href="bejelentkezes.php">Bejelentkezés</a></li>
            <li class="nav-li" style="background-color: rgb(59, 25, 255);"><a class="a" href="regisztracio.php">Regisztáció</a></li>
            <li class="nav-li"><a class="a" href="index.php">Főoldal</a></li>
        </ul>
    </nav>

    <main>
        <div id="reg-text">Regisztráció</div>
        <hr>
        <form class="reg-form" action="regisztracio.php" method="post">
            <fieldset class="reg-fieldset">
                <div class="grid-container">
                    <div class="grid-item">
                        <label for="uname">Felhasználónév:</label>    
                    </div>
                    
                    <div class="grid-item">
                        <input type="text" name="uname" placeholder="kovacsmiklos05" required>
                    </div>

                    <div class="grid-item">    
                        <label for="lastname">Vezetéknév:</label>
                    </div>
                    
                    <div class="grid-item">
                        <input type="text" name="lastname" placeholder="Kovács" required>
                    </div>

                    <div class="grid-item">
                        <label for="firstname">Keresztnév:</label>
                    </div>
                    
                    <div class="grid-item">
                        <input type="text" name="firstname" placeholder="Miklós" required>
                    </div>

                    <div class="grid-item">
                        <label for="email">Email:</label>
                    </div>
                    
                    <div class="grid-item">
                        <input type="email" name="email" placeholder="kovacsmiklos05@gmail.com" required>
                    </div>

                    <div class="grid-item">
                        <label for="pw">Jelszó:</label>
                    </div>
                    
                    <div class="grid-item">
                        <input type="password" name="pw" required>
                    </div>

                    <div class="grid-item">
                        <label for="pw-again">Jelszó újra:</label>
                    </div>
                    
                    <div class="grid-item">
                        <input type="password" name="pw-again" required>
                    </div>
                </div>      
            </fieldset>
            <?php 
                if (isset($successful) && $successful === true) {
                    echo "<p>Sikeres regisztráció!</p>";
                } else {
                    foreach ($hibak as $hiba) {
                        echo "<p style='color: red; text-align: center; margin: 0;'>" . $hiba . "</p>";
                    }
                }
            ?>

            <input type="submit" value="Regisztálok" class="reg-btn" name="register-btn">
        </form>
    </main>
    
    <footer>

    </footer>
</body>
</html>