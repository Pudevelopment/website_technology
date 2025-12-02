<?php

require_once "config.php";

$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if ($db === false) {
    echo "<script>alert('Datenbankverbindung fehlgeschlagen');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="PU Development - Erkunden Sie verschiedene Technologien rund um Pistengeräte.">
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <title>Pistengeräte</title>
        <link rel="icon" type="image/jpg"
        href="images/icons/cable-car.png">
    </head>

    <body>
        <div class="seilbahn">
            <header>
                <div id="tohub">
                    <input type="submit" class="btn-teriträr" name="submit" value="Home" id="btn-tohub" >
                </div>
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                                if (isset($_POST['id'])){
                                    $id = intval($_POST['id']); 
                                    $stmt = $db->prepare("SELECT * FROM pistengeraetedaten WHERE id = ?");
                                    if ($stmt) {
                                        $stmt->bind_param("i", $id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                            
                                        if ($result && $result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            echo "<h1>" . htmlspecialchars($row['h1name']) . "</h1>";
                                        } else {
                                            echo "Keine Ergebnisse gefunden.";
                                        }
                            
                                        $stmt->close();
                                    } else {
                                        echo "Datenbankabfrage fehlgeschlagen.";
                                    }
                                } else {
                                    echo "Ungültige ID.";
                                }
                            }else{
                                echo "<h1>Pistengeräte</h1>";
                            }
                ?>
                <div id="logout">
                    <input type="submit" class="btn-teriträr" name="submit" value="Anmelden" id="btn-login" >
                </div>
            </header>
            <main>
                <div class="auswahl">
                    <?php 
                        echo "<h2>Pistenraupen</h2>";
                        for ($i = 0; $i <= 3; $i++) {
                            $stmt = $db->prepare("SELECT name, id FROM pistengeraetedaten WHERE typ_db = ?");
                            $stmt->bind_param("i", $i);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && $result->num_rows > 0) {
                                switch ($i) {
                                    case 1:
                                        echo "<h3>Mit Winde</h3>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<form method='POST'>";
                                            echo "<button type='submit' name='id' value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</button>";
                                            echo "</form> ";
                                        }
                                        break;

                                    case 2:
                                        echo "<h3>Ohne Winde</h3>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<form method='POST'>";
                                            echo "<button type='submit' name='id' value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</button>";
                                            echo "</form> ";
                                        }
                                        break;

                                    case 3:
                                        echo "<h3>Sonstige</h3>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<form method='POST'>";
                                            echo "<button type='submit' name='id' value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</button>";
                                            echo "</form> ";
                                        }
                                        break;
         
                                    default:
                                        echo "<h3>Keine spezifische Kategorie für typ_db = {$i}</h3>";
                                        while ($row = $result->fetch_assoc()) {
                                            
                                        }
                                        break;
                                }
                            } else {
                                //echo "<h3>Keine Einträge für typ_db = {$i}</h3>";
                            }
                        }
                    ?>
                </div>
                <div class="gondel">
                    <?php   if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                                if (isset($_POST['id'])){
                                    $id = intval($_POST['id']); 
                                    $stmt = $db->prepare("SELECT * FROM pistengeraetedaten WHERE id = ?");
                                    $stmt->bind_param("i", $id); 
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result && $result->num_rows > 0):
                                    while ($row = $result->fetch_assoc()): ?>
                                        <div class="pic-db">
                                            <img src="<?= htmlspecialchars($row['Bildpfad'] ?? 'images/icons/nopicture.png') ?>" alt="Bild <?= htmlspecialchars($row['Bildpfad'] ? $row['h1name'] : 'No picture') ?>">
                                        </div>
                                        <table>
                                        <tr>
                                            <td><div class="tablefest">Typ:</div></td>
                                            <td><?= htmlspecialchars($row['Typ']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Hersteller:</div></td>
                                            <td><?= htmlspecialchars($row['Hersteller']) ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Länge des Fahrzeuges:</div></td>
                                            <td><?= $row['lgeraet'] !== null ? htmlspecialchars($row['lgeraet']) . ' m' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Breite des Fahrzeuges:</div></td>
                                            <td><?= $row['bgeraet'] !== null ? htmlspecialchars($row['bgeraet']) . ' m' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Höhe des Fahrzeuges:</div></td>
                                            <td><?= $row['hgeraet'] !== null ? htmlspecialchars($row['hgeraet']) . ' m' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Gewicht:</div></td>
                                            <td><?= $row['Gewicht'] !== null ? htmlspecialchars($row['Gewicht']) . ' kg' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Geschwindigkeit:</div></td>
                                            <td><?= $row['geschwindigkeit'] !== null ? htmlspecialchars($row['geschwindigkeit']) . ' °' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Leistung:</div></td>
                                            <td><?= $row['leistung'] !== null ? htmlspecialchars($row['leistung']) . ' m/s' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Zugkraft der Winde:</div></td>
                                            <td><?= $row['zugkraft'] !== null ? htmlspecialchars($row['zugkraft']) . ' kN' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Winde:</div></td>
                                            <td>
                                                <?= $row['Winde'] 
                                                    ? '<img src="images/icons/check.png" alt="Vorhanden" height="30px">' 
                                                    : '<img src="images/icons/cross.png" alt="Nicht Vorhanden" height="30px">' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Besonderheiten:</div></td>
                                            <td><?= htmlspecialchars($row['Besonderheiten'] ?? '-') ?></td>
                                        </tr>
                                        </table>
                                    <?php endwhile; ?>
                                <?php endif;
                                }
                            mysqli_close($db);
                    }else{
                        echo '
                        <iframe id="ytplayer" type="text/html" width="2000vh" height="1069vh"src="https://www.youtube.com/watch?v=sdC9WXNNEKo?autoplay=1&controls=0&disablekb=1&fs=0&loop=1&modestbranding=1&playlist=jY0yxxSy3NI&mute=1"frameborder="0" allowfullscreen></iframe>';
                    } 
                    ?>
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
        </div>
        
        <script>
            document.getElementById('btn-login').addEventListener('click', function() {//Zum Login wechseln
                window.location.href = 'login.php';
            });

            document.getElementById('btn-tohub').addEventListener('click', function() {
                window.location.href = 'index.php';
            });

            document.addEventListener("DOMContentLoaded", function () {
                const auswahlContainer = document.querySelector('.seilbahn .auswahl');
                const scrollPositionKey = 'auswahlScrollPosition';
                const savedPosition = sessionStorage.getItem(scrollPositionKey);

                if (savedPosition) {
                    auswahlContainer.scrollTop = parseInt(savedPosition, 10);
                }

                auswahlContainer.addEventListener('scroll', () => {
                    sessionStorage.setItem(scrollPositionKey, auswahlContainer.scrollTop);
                });

                document.querySelectorAll('.seilbahn .auswahl button').forEach(button => {
                    button.addEventListener('click', () => {
                        setTimeout(() => {
                            auswahlContainer.scrollTop = parseInt(sessionStorage.getItem(scrollPositionKey), 10);
                        }, 100); 
                    });
                });
            });

            window.addEventListener('load', function() {
                const Ilovecookies = sessionStorage.getItem('Ilovecookies');
                if (Ilovecookies === null) {
                    window.location.href = 'index.php';
                }
            });
        </script>
    </body>
        <!-- 
        Kabinenbahnen
            1 = Funitel
            2 = 3S-Bahn
            3 = Einseilumlaufbahn
            4 = Pendelbahn
        
        Sessellifte
            5 = Schlepplift
            6 = 2er
            7 = 4er
            8 = 6er
            9 = 8er
        Besondere
            10 = Besondere
        -->
</html>