<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/jpg"
          href="images/icons/cable-car.png">
    <title>Home</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
    <header>
        <h1><b>Home</b></h1>
        <div id="logout">
            <input type="submit" class="btn-teriträr" name="submit" value="Login" id="btn-login" >
        </div>
    </header>
    
    <main>
        <table>
            <tr>
                <th id="cableway">Seilbahn</th>
                <th>Pistengeräte</th>
                <th>Beschneiungsanlagen</th>
            </tr>
            <tr>
                <td id="cableway"><img src="images/seilbahnen/jochbahn.JPG" alt="Bild Seilbahn"></td>
                <td><img src="images/pistengeraete/600W.jpg" alt="Bild Pistengerät"></td>
                <td><img src="images/beschneiungsanlagen/tf10.jpg" alt="Bild Beschneiungsanlage"></td>
            </tr>
        </table>
    </main>

    <footer>
        <p>
            <a href="Impressum.php">Impressum</a>
        </p>
        <p>&copy; 2024-2025 Philipp Uhlendorf</p>
        <p>
            <a href="Datenschutz.php">Datenschutz</a>
        </p>
    </footer>
    <script>
        document.getElementById('btn-login').addEventListener('click', function() {//Zum Login wechseln
                window.location.href = 'login.php';
            });

        document.getElementById('cableway').addEventListener('click', function() {//Zur Seilbahn Seite wechseln
                window.location.href = 'seilbahnen.php';
            });
    </script>
</body>
</html>