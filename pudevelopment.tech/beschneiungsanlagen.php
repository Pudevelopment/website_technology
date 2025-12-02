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
        <meta name="description" content="PU Development - Erkunden Sie verschiedene Technologien rund um Beschneiungsanlagen.">
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <title>Beschneiungsanlagen</title>
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
                                    $stmt = $db->prepare("SELECT * FROM beschneiungsanlagendaten WHERE id = ?");
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
                                echo "<h1>Beschneiungsanlagen</h1>";
                            }
                ?>
                <div id="logout">
                    <input type="submit" class="btn-teriträr" name="submit" value="Anmelden" id="btn-login" >
                </div>
            </header>
            <main>
                <div class="auswahl">
                    <?php 
                        echo "<h2>Schneekanonen</h2>";
                        for ($i = 0; $i <= 3; $i++) {
                            $stmt = $db->prepare("SELECT name, id FROM beschneiungsanlagendaten WHERE typ_db = ?");
                            $stmt->bind_param("i", $i);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && $result->num_rows > 0) {
                                switch ($i) {
                                    case 1:
                                        echo "<h3>Propelleranlagen</h3>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<form method='POST'>";
                                            echo "<button type='submit' name='id' value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</button>";
                                            echo "</form> ";
                                        }
                                        break;

                                    case 2:
                                        echo "<h3>Schneilanzen</h3>";
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
                                    $stmt = $db->prepare("SELECT * FROM beschneiungsanlagendaten WHERE id = ?");
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
                                            <td><div class="tablefest">Nennspannung:</div></td>
                                            <td><?= $row['nennspannung'] !== null ? htmlspecialchars($row['nennspannung']) . ' kV' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Betriebstemperatur:</div></td>
                                            <td><?= $row['betriebstemp'] !== null ? htmlspecialchars($row['betriebstemp']) . ' °C' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Drehzahl:</div></td>
                                            <td><?= $row['drehzahl'] !== null ? htmlspecialchars($row['drehzahl']) . ' rpm' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Schwenkradius:</div></td>
                                            <td><?= $row['schwenkradius'] !== null ? htmlspecialchars($row['schwenkradius']) . ' °' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Horizontaledrehung:</div></td>
                                            <td><?= $row['horizontaledrehung'] !== null ? htmlspecialchars($row['horizontaledrehung']) . ' °' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Turbinenneigung:</div></td>
                                            <td><?= $row['turbinenneigung'] !== null ? htmlspecialchars($row['turbinenneigung']) . ' m/s' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Wasserdruck:</div></td>
                                            <td><?= $row['wasserdruck'] !== null ? htmlspecialchars($row['wasserdruck']) . ' Bar' : '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="tablefest">Nennleistung:</div></td>
                                            <td><?= $row['nennleistung'] !== null ? htmlspecialchars($row['nennleistung']) . ' kW' : '-' ?></td>
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
                        <iframe id="ytplayer" type="text/html" width="2000vh" height="1069vh"src="https://www.youtube.com/embed/CQfefRKBZFw?autoplay=1&controls=0&disablekb=1&fs=0&loop=1&modestbranding=1&playlist=jY0yxxSy3NI&mute=1"frameborder="0" allowfullscreen></iframe>';
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