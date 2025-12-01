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
            <div id="seitenauswahl">
                <h2>Unser Informationsangebot über: </h2>
                <br>
                <table>
                    <tr>
                        <th id="cableway">Seilbahn</th>
                        <th id="slopevehicles">Pistengeräte</th>
                        <th id="snowmaking">Beschneiungsanlagen</th>
                    </tr>
                    <tr>
                        <td id="cableway"><img src="images/seilbahnen/jochbahn.JPG" alt="Bild Seilbahn" width="30vh"></td>
                        <td id="slopevehicles"><img src="images/pistengeraete/600W.jpg" alt="Bild Pistengerät" width="30vh"></td>
                        <td id="snowmaking"><img src="images/beschneiungsanlagen/tf10.jpg" alt="Bild Beschneiungsanlage" width="30vh"></td>
                    </tr>
                </table>
            </div>
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
            document.getElementById('slopevehicles').addEventListener('click', function() {//Zur Pistengeräte Seite wechseln
                    alert("Seite nicht verfügbar");
                });
            document.getElementById('snowmaking').addEventListener('click', function() {//Zur Beschneiungsanlagen Seite wechseln
                    alert("Seite nicht verfügbar");
                });
        </script>
    </body>
</html>