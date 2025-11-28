<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <title>Datenschutz</title>
        <link rel="icon" type="image/jpg"
              href="images/icons/cable-car.png">
    </head>
    <body>
        <header>
            <h1> Datenschutz</h1>
            <div id="logout">
                <input type="submit" class="btn-teriträr" name="submit" value="Zurück" id="btn-back" >
            </div>
        </header>

        <main>
            <p><center>Hier finden sie demnächst die Datenschutzerkärung</center></p>
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
            document.getElementById('btn-back').addEventListener('click', function() {//Zum Login wechseln
                 window.location.href = 'Homepage.php';
            });
        </script>
    </body>
</html>