<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adatbázis törlése</title>
</head>
<body>
    <?php
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $connection = new mysqli($servername, $username, $password);
        if ($connection->connect_error) {
            die("csatlakozási hiba: " . $connection->connect_error);
        }

        $query = "DROP DATABASE tananyagkezelo";
        $result = $connection->query($query);
        if ($result === TRUE) {
            echo "Adatbázis sikeresen törölve!<br>";
        } else {
            echo "HIBA az adatbázis törlése során: " . $connection->error;
        }

        $connection->close();
    ?>
</body>
</html>