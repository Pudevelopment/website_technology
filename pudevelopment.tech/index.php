<!doctype html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/indexstyle.css" />
        <link rel="icon" type="image/jpg"
            href="images/icons/cable-car.png">
        <title>Home</title>
    </head>
    <body>
        <header>
            <h1><b>Willkommen</b></h1>
            <div id="logout">
                <input type="submit" class="btn-teriträr" name="submit" value="Login" id="btn-login" >
            </div>
        </header>
        
        <main>
            <div class="homes">
                <div id="seitenauswahl">
                    <div id="seitenauswahl-text">
                        <h2>Hier finden Sie unser Informationsangebot über:</h2>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="table-seitenauswahl">
                        <table>
                            <tr>
                                <td id="cableway" rowspan="2"><p>Seilbahn</p><br><img src="images/seilbahnen/jochbahn.JPG" alt="Bild Seilbahn"></td>
                                <td id="slopevehicles" rowspan="2"><p>Pistengeräte</p> <br><img src="images/pistengeraete/600W.jpg" alt="Bild Pistengerät"></td>
                                <td id="snowmaking" rowspan="2"><p>Beschneiungsanlagen</p> <br><img src="images/beschneiungsanlagen/tf10.jpg" alt="Bild Beschneiungsanlage"></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                      <br>
                    <br>
                    <br>
                    <br>
                    <div id="seitenauswahl-text">
                        <h2> Hier finden Sie den Quellcode und die Lizenz</h2>
                    </div>
                    <br>
                    <div id="togithub">
                        <input type="submit" class="btn-quintär" name="submit" value="Zu Github wechseln" id="btn-github"> 
                    </div>
                </div>
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