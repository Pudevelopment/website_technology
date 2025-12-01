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
            <h1><b>Willkommen</b></h1>
            <div id="logout">
                <input type="submit" class="btn-teriträr" name="submit" value="Login" id="btn-login" >
            </div>
        </header>
        
        <main>
            <div id="seitenauswahl">
                <h2>Hier finden Sie unser Informationsangebot über:</h2>
                <br>
                <table>
                    <tr>
                        <th id="cableway">Seilbahn</th>
                        <th id="slopevehicles">Pistengeräte</th>
                        <th id="snowmaking">Beschneiungsanlagen</th>
                    </tr>
                    <tr>
                        <td><img src="images/seilbahnen/jochbahn.JPG" alt="Bild Seilbahn" width="30vh" id="cableway"></td>
                        <td><img src="images/pistengeraete/600W.jpg" alt="Bild Pistengerät" width="30vh" height="auto" id="slopevehicles"></td>
                        <td><img src="images/beschneiungsanlagen/tf10.jpg" alt="Bild Beschneiungsanlage" width="20vh" height="auto" id="snowmaking"></td>
                    </tr>
                </table>
                <br>
                <h2> Hier finden Sie den Quellcode und die Lizenz</h2>
                <br>
                <input type="submit" class="btn-quintär" name="submit" value="Zu Github wechseln" id="btn-github"> 
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
            document.getElementById('btn-github').addEventListener('click', function() {//Zu Github wechseln
                    window.open("https://github.com/Pudevelopment/website_technology", "_blank");
                });
        </script>
    </body>
</html>