<?php 
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
    <title>Tananyag</title>
</head>
<body>
    
</body>
</html>