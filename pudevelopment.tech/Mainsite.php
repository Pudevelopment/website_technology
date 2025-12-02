<?php
session_start();

if (!isset($_SESSION["userid"]) || $_SESSION["userid"] === false) {
    header("location: login.php");
    exit;
}
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="PU Development - Administrativer Bereich und Benutzerverwaltung.">
        <link rel="stylesheet" type="text/css" href="../css/loginstyle.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Administrativer Bereich</title>
        <link rel="icon" type="image/jpg"
        href="images/icons/cable-car.png">
    </head>

    <body>
        <header>
            <div id="showprofile">
                <input type="button" class="btn-teriträr" value="Profil" id="btn-profile" >
            </div>
            <div id="welcometext">
                <?php
                    $userid = $_SESSION["userid"];
                    $query = "SELECT * FROM users WHERE id = ?";
                    $stmt = $db->prepare($query);
                    $stmt->bind_param("i", $userid);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                ?>
            <h1>Willkommen <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></h1> 
            </div>
            <div id="logout">
                <input type="button" class="btn-teriträr" value="Abmelden" id="btn-logout" >
            </div>
        </header>
        <main>
            <div class="flex-container">
                <div id="functions">
                    <h2>Informationsverwaltung</h2>
                    <input type="submit" class="btn-quarter" name="submit" value="Seilbahn hinzufügen" onclick="showForm('registerbahn')">
                    <br>
                    <input type="submit" class="btn-quarter" name="submit" value="Seilbahn entfernen" onclick="showForm('loeschenbahn')">
                    <br>
                    <input type="submit" class="btn-quarter" name="submit" value="Pistengeräte hinzufügen" onclick="showForm('registerpistengeraet')">
                    <br>
                    <input type="submit" class="btn-quarter" name="submit" value="Pistengeräte entfernen" onclick="showForm('loeschenpistengeraet')">
                    <br>
                    <input type="submit" class="btn-quarter" name="submit" value="Beschneiungsanlagen hinzufügen" onclick="showForm('registerbeschneiung')">
                    <br>
                    <input type="submit" class="btn-quarter" name="submit" value="Beschneiungsanlagen entfernen" onclick="showForm('loeschenbeschneiung')">
                    <br>
                    <?php
                        if ($_SESSION['status'] == 1){
                            echo "<h2>Administration</h2>";
                            echo "<input type='submit' class='btn-quarter' name='submit' value='Neuen Zugang anlegen' onclick=\"showForm('registernutzer')\">";
                            echo "<br>";
                            echo "<input type='submit' class='btn-quarter' name='submit' value='Zugang löschen' onclick=\"showForm('loeschennutzer')\">";
                            echo "<br>";
                            echo "<input type='submit' class='btn-quarter' name='submit' value='Benutzer anzeigen' onclick=\"showForm('showuser')\">";
                            echo "<br>";
                        }else{
                            echo "<input type='submit' class='btn-quarter' name='submit' value='Neuen Zugang anlegen' hidden onclick=\"showForm('registernutzer')\">";
                            echo "<input type='submit' class='btn-quarter' name='submit' value='Zugang löschen' hidden onclick=\"showForm('loeschennutzer')\">";
                            echo "<input type='submit' class='btn-quarter' name='submit' value='Benutzer anzeigen' hidden onclick=\"showForm('showuser')\">";
                        }
                    ?>
                </div>
                <div id="registerbahn" class="form-container">
                   <div id="reg-bahn">
                        <form method="POST" action="reg-bahn.php">
                            <h1>Seilbahn hinzufügen</h1>
                            <div class="bahn-form">
                                    <?php  if (isset($_SESSION['bahnresult'])):
                                                echo ($_SESSION["bahnresult"]);
                                                unset($_SESSION["bahnresult"]);
                                            endif;
                                            
                                    ?>
                            </div>
                            <h3>Pflichtfelder</h3>
                            <div class="bahn-form">
                                <input type="text" name="name" class="form-control" placeholder="Bahnname (Standort)" required oninvalid="this.setCustomValidity('Bitte einen gültigen Namen und Standort in Klammern, angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="bahn-form">
                                <input type="text" name="h1name" class="form-control" placeholder="Bahnname" required oninvalid="this.setCustomValidity('Bitte einen gültigen Bahnnamen eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="baujahr" class="form-control" placeholder="Baujahr" required oninvalid="this.setCustomValidity('Bitte eine gültige Jahreszahl eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="bahn-form">
                                <input type="text" name="typ" class="form-control" placeholder="Bahntyp" required oninvalid="this.setCustomValidity('Bitte einen gültigen Seilbahntyp angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="bahn-form">
                                    <select id="typ_db" name="typ_db" required oninvalid="this.setCustomValidity('Bitte eine Kategorie auswählen')" oninput="setCustomValidity('')">
                                            <option value="" selected ="selected">(Wählen Sie eine Katergorie)</option>
                                            <option value="1">Funitel</option>
                                            <option value="2">3S-Bahn</option>
                                            <option value="3">Einseilumlaufbahn</option>
                                            <option value="4">Pendelbahn</option>
                                            <option value="5">Schlepplift</option>
                                            <option value="6">2er Sessellift</option>
                                            <option value="7">4er Sessellift</option>
                                            <option value="8">6er Sessellift</option>
                                            <option value="9">8er Sessellift</option>
                                            <option value="10">Sonstige</option>
                                    </select>
                            </div>
                            <div class="bahn-form">
                                <input type="text" name="standort" class="form-control" placeholder="Standort (Länderkürzel)" required oninvalid="this.setCustomValidity('Bitte einen gültigen Standort mit Länderkürzel eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="bahn-form">
                                <input type="text" name="hersteller" class="form-control" placeholder="Hersteller" required oninvalid="this.setCustomValidity('Bitte einen gültigen Hersteller eingeben')" oninput="setCustomValidity('')">
                            </div>

                            <h3>Optionale Felder</h3>
                            <div class="bahn-form">
                                <input type="number" name="htal" class="form-control" placeholder="Höhe Talstation in Metern">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="hberg" class="form-control" placeholder="Höhe Bergstation in Metern">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="hdiff" class="form-control" placeholder="Höhendifferenz in Metern">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="horizontlang" class="form-control" placeholder="Streckenlänge in Metern">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="bodenabstand" class="form-control" placeholder="Maximaler Bodenabstand in Metern">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="maxspeed" class="form-control" placeholder="Fahrgeschwindigkeit in Metern pro Sekunde">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="maxförderleistung" class="form-control" placeholder="Maximale Förderleistung in Personen pro Stunde">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="fahrzeit" class="form-control" placeholder="Fahrzeit in Minuten">
                            </div>
                            <div class="bahn-form">
                                <input type="number" name="perspromittel" class="form-control" placeholder="Personen pro Transportmittel in Personen">
                            </div>
                            <div class="bahn-form">
                                <input type="text" name="artgaragierung" class="form-control" placeholder="Art der Garagierung">
                            </div>
                            <div class="bahn-form">
                                <div class="check-bahn">
                                    <input type="hidden" name="kuppelbar" value="0">
                                    <input type="checkbox" name="kuppelbar" id="id-kuppelbar" value="1">
                                    <br>
                                    <label for="id-kuppelbar">Kuppelbar?</label>
                                    <br>
                                    <br>
                                    <input type="hidden" name="sitzheizung" value="0">
                                    <input type="checkbox" name="sitzheizung" id="id-sitzheizung" value="1">
                                    <br>
                                    <label for="id-sitzheizung">Sitzheizung vorhanden?</label>
                                    </div>
                            </div>
                            <div class="bahn-form">
                                <input type="text" name="bildpfad" class="form-control" placeholder="Relativer Pfad für Bilddatei">
                            </div>
                            <div class="bahn-form">
                                <input type="text" name="besonderheiten" class="form-control" placeholder="Besonderheiten">
                            </div>
                            <div class="bahn-form">
                                <div class="btn-bahn-submit">
                                    <input type="submit" name="submit" class="form-control" placeholder="Hinzufügen">
                                    <button type="reset">Formular leeren</button>
                                    <br>
                                    <p> </p>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
                <div id="loeschenbahn" class="form-container">
                    <div id="del-bahn">
                        <form method="POST" action="del-bahn.php">
                            <h1>Seilbahn löschen</h1>
                            <div class="bahn-form">
                                <input type="text" name="name" class="form-control" placeholder="Bahnname (Standort)" required oninvalid="this.setCustomValidity('Bitte einen gültigen Namen und Standort in Klammern, angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="bahn-form">
                                <input type="text" name="h1name" class="form-control" placeholder="Bahnname" required oninvalid="this.setCustomValidity('Bitte einen gültigen Bahnnamen eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="bahn-form">
                                <div class="btn-bahn-submit">
                                    <input type="submit" name="submit" class="form-control" value="Löschen">
                                    <button type="reset">Formular leeren</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="registerpistengeraet" class="form-container">
                   <div id="reg-pistengeraet">
                        <form method="POST" action="reg-pistengeraet.php">
                            <h1>Pistengerät hinzufügen</h1>
                            <div class="pistengeraet-form">
                                    <?php  if (isset($_SESSION['pistengeraetresult'])):
                                                echo ($_SESSION["pistengeraetresult"]);
                                                unset($_SESSION["pistengeraetresult"]);
                                            endif;
                                            
                                    ?>
                            </div>
                            <h3>Pflichtfelder</h3>
                            <div class="pistengeraet-form">
                                <input type="text" name="name" class="form-control" placeholder="Gerätename (Hersteller)" required oninvalid="this.setCustomValidity('Bitte einen gültigen Namen und Standort in Klammern, angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="text" name="h1name" class="form-control" placeholder="Gerätename" required oninvalid="this.setCustomValidity('Bitte einen gültigen Bahnnamen eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="text" name="typ" class="form-control" placeholder="Gerätetyp" required oninvalid="this.setCustomValidity('Bitte einen gültigen Seilbahntyp angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="pistengeraet-form">
                                    <select id="typ_db" name="typ_db" required oninvalid="this.setCustomValidity('Bitte eine Kategorie auswählen')" oninput="setCustomValidity('')">
                                            <option value="" selected ="selected">(Wählen Sie eine Katergorie)</option>
                                            <option value="1">Mit Winde</option>
                                            <option value="2">Ohne Winde</option>
                                            <option value="3">Sonstige</option>
                                    </select>
                            </div>
                            <div class="pistengeraet-form">
                                <input type="text" name="hersteller" class="form-control" placeholder="Hersteller" required oninvalid="this.setCustomValidity('Bitte einen gültigen Hersteller eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <h3>Optionale Felder</h3>
                            <div class="pistengeraet-form">
                                <input type="number" name="lgeraet" class="form-control" placeholder="Fahrzeug Länenge in Metern">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="number" name="bgeraet" class="form-control" placeholder="Fahrzeug Breite in Metern">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="number" name="hgeraet" class="form-control" placeholder="Fahrzeug Höhe in Metern">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="number" name="Gewicht" class="form-control" placeholder="Gewicht in Kilogramm">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="number" name="leistung" class="form-control" placeholder="Leistung in Kilowatt">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="number" name="zugkraft" class="form-control" placeholder="Zugkraft der Winde in kN">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="number" name="geschwindigkeit" class="form-control" placeholder="Maximale Geschwindigkeit in km/h">
                            </div>
                            <div class="pistengeraet-form">
                                <div class="check-pistengeraet">
                                    <input type="hidden" name="winde" value="0">
                                    <input type="checkbox" name="winde" id="id-winde" value="1">
                                    <br>
                                    <label for="id-winde">Winde?</label>
                                    <br>
                                    <br>                    
                                    </div>
                            </div>
                            <div class="pistengeraet-form">
                                <input type="text" name="bildpfad" class="form-control" placeholder="Relativer Pfad für Bilddatei">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="text" name="besonderheiten" class="form-control" placeholder="Besonderheiten">
                            </div>
                            <div class="pistengeraet-form">
                                <div class="btn-pistengeraet-submit">
                                    <input type="submit" name="submit" class="form-control" placeholder="Hinzufügen">
                                    <button type="reset">Formular leeren</button>
                                    <br>
                                    <p> </p>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
                <div id="loeschenpistengeraet" class="form-container">
                    <div id="del-pistengeraet">
                        <form method="POST" action="del-pistengeraet.php">
                            <h1>Pistengeräte löschen</h1>
                            <div class="pistengeraet-form">
                                <input type="text" name="name" class="form-control" placeholder="Gerätename (Hersteller)" required oninvalid="this.setCustomValidity('Bitte einen gültigen Namen und Hersteller in Klammern, angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="pistengeraet-form">
                                <input type="text" name="h1name" class="form-control" placeholder="Gerätename" required oninvalid="this.setCustomValidity('Bitte einen gültigen Gerätenamen eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="pistengeraet-form">
                                <div class="btn-pistengeraet-submit">
                                    <input type="submit" name="submit" class="form-control" value="Löschen">
                                    <button type="reset">Formular leeren</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="registerbeschneiung" class="form-container">
                   <div id="reg-beschneiung">
                        <form method="POST" action="reg-beschneiung.php">
                            <h1>Beschneiungsanlage hinzufügen</h1>
                            <div class="beschneiung-form">
                                    <?php  if (isset($_SESSION['beschneiungresult'])):
                                                echo ($_SESSION["beschneiungresult"]);
                                                unset($_SESSION["beschneiungresult"]);
                                            endif;
                                            
                                    ?>
                            </div>
                            <h3>Pflichtfelder</h3>
                            <div class="beschneiung-form">
                                <input type="text" name="name" class="form-control" placeholder="Anlagenname (Hersteller)" required oninvalid="this.setCustomValidity('Bitte einen gültigen Namen und Standort in Klammern, angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="beschneiung-form">
                                <input type="text" name="h1name" class="form-control" placeholder="Anlagenname" required oninvalid="this.setCustomValidity('Bitte einen gültigen Bahnnamen eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="beschneiung-form">
                                <input type="text" name="typ" class="form-control" placeholder="Gerätetyp" required oninvalid="this.setCustomValidity('Bitte einen gültigen Seilbahntyp angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="beschneiung-form">
                                    <select id="typ_db" name="typ_db" required oninvalid="this.setCustomValidity('Bitte eine Kategorie auswählen')" oninput="setCustomValidity('')">
                                            <option value="" selected ="selected">(Wählen Sie eine Katergorie)</option>
                                            <option value="1">Propelleranlagen</option>
                                            <option value="2">Schneilanzen</option>
                                            <option value="3">Sonstige</option>
                                    </select>
                            </div>
                            <div class="beschneiung-form">
                                <input type="text" name="hersteller" class="form-control" placeholder="Hersteller" required oninvalid="this.setCustomValidity('Bitte einen gültigen Hersteller eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <h3>Optionale Felder</h3>
                            <div class="beschneiung-form">
                                <input type="number" name="nennspannung" class="form-control" placeholder="Nennspannung in Volt">
                            </div>
                            <div class="beschneiung-form">
                                <input type="text" name="betriebstemp" class="form-control" placeholder="Betriebstemperatur in °C">
                            </div>
                            <div class="beschneiung-form">
                                <input type="number" name="drehzahl" class="form-control" placeholder="Drehzahl in Umdrehungen pro Minute">
                            </div>
                            <div class="beschneiung-form">
                                <input type="number" name="schwenkung" class="form-control" placeholder="Maximale Schwenkung in Grad">
                            </div>
                            <div class="beschneiung-form">
                                <input type="number" name="horizontaledrehung" class="form-control" placeholder="Horizontale Drehung in Grad">
                            </div>
                            <div class="beschneiung-form">
                                <input type="number" name="turbinenneigung" class="form-control" placeholder="Turbinenneigung in Grad">
                            </div>
                            <div class="beschneiung-form">
                                <input type="number" name="wasserdruck" class="form-control" placeholder="Wasserdruck in Bar">
                            </div>
                            <div class="beschneiung-form">
                                <input type="number" name="nennleistung" class="form-control" placeholder="Nennleistung in kW">
                            </div>
                            <div class="beschneiung-form">
                                <input type="text" name="bildpfad" class="form-control" placeholder="Relativer Pfad für Bilddatei">
                            </div>
                            <div class="beschneiung-form">
                                <input type="text" name="besonderheiten" class="form-control" placeholder="Besonderheiten">
                            </div>
                            <div class="beschneiung-form">
                                <div class="btn-beschneiung-submit">
                                    <input type="submit" name="submit" class="form-control" placeholder="Hinzufügen">
                                    <button type="reset">Formular leeren</button>
                                    <br>
                                    <p> </p>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
                <div id="loeschenbeschneiung" class="form-container">
                    <div id="del-beschneiung">
                        <form method="POST" action="del-beschneiung.php">
                            <h1>Beschneiungsanlagen löschen</h1>
                            <div class="beschneiung-form">
                                <input type="text" name="name" class="form-control" placeholder="Anlagenname (Hersteller)" required oninvalid="this.setCustomValidity('Bitte einen gültigen Namen und Hersteller in Klammern, angeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="beschneiung-form">
                                <input type="text" name="h1name" class="form-control" placeholder="Anlagenname" required oninvalid="this.setCustomValidity('Bitte einen gültigen Gerätenamen eingeben')" oninput="setCustomValidity('')">
                            </div>
                            <div class="beschneiung-form">
                                <div class="btn-beschneiung-submit">
                                    <input type="submit" name="submit" class="form-control" value="Löschen">
                                    <button type="reset">Formular leeren</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="registernutzer" class="form-container">
                    <div id="reg-nutzer">
                        <form method="post" action="register.php">
                            <h1>Neuen Zugang anlegen</h1>
                            <div class="reg-form">
                                <input type="text" name="name" class="form-control" placeholder="Vor- und Nachname" required oninvalid="this.setCustomValidity('Bitte einen gültigen Namen eingeben')" oninput="setCustomValidity('')" autocomplete="name">
                            </div>
                            <div class="reg-form">
                                <input type="email" name="email" class="form-control" placeholder="E-Mail" autocomplete="email"/>
                            </div>
                            <div class="reg-form">
                                <input type="password" name="password" class="form-control" placeholder="Passwort" autocomplete="new-password">
                            </div>
                            <div class="reg-form">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Passwort wiederholen" autocomplete="new-password">
                            </div>
                            <br>
                            <div class="reg-form">
                                <div class="btn-reg-submit">
                                    <input type="submit" name="submit" class="btn-primary" value="Registrieren" >
                                    <button type="reset">Formular leeren</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="loeschennutzer" class="form-container">
                    <div id="del-nutzer">
                        <form method="POST" action="del-nutzer.php">
                            <h1>Zugang löschen</h1>
                            <div class="reg-form">
                                <input type="email" name="email" class="form-control" placeholder="E-Mail" required oninvalid="this.setCustomValidity('Bitte eine gültige E-Mail angeben')" oninput="setCustomValidity('')" autocomplete="username">
                            </div>
                            <div class="reg-form">
                                <input type="password" name="password" class="form-control" placeholder="Passwort" required oninvalid="this.setCustomValidity('Bitte einen gültiges Passwort eingeben')" oninput="setCustomValidity('')" autocomplete="current-password">
                            </div>
                            <div class="reg-form">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Passwort erneut eingeben" required oninvalid="this.setCustomValidity('Bitte einen gültiges Passwort eingeben')" oninput="setCustomValidity('')" autocomplete="current-password">
                            </div>
                            <div class="reg-form">
                                <div class="btn-reg-submit">
                                    <input type="submit" name="submit" class="form-control" value="Löschen">
                                    <button type="reset">Formular leeren</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="showuser" class="form-container">
                    <div id="show-task">
                        <form method="POST">
                            <h1>Nutzer anzeigen</h1>
                            <?php
                                $stmt = $db->prepare("SELECT name, id FROM users");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if($result->num_rows > 0){
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<form method='POST' >";
                                        echo "<div class='reg-form'>";
                                        echo "<button type='submit' name='userid' value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</button>";
                                        echo "</div>";
                                        echo "</form> ";
                                    }
                                }else{
                                    echo "<div class='reg-form'>";
                                    echo "<p>Keine Nutzer gefunden</p>";
                                    echo "</div>";
                                    echo "<br><br><br><br>";
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </main> 
        <footer>
            <p>
                <a href="../html/Impressum.html">Impressum</a>
            </p>
            <p>&copy; 2024-2025 Philipp Uhlendorf</p>
            <p>
                <a href="../html/Datenschutz.html">Datenschutz</a>
            </p>
        </footer>
        <?php
        if (!empty($_SESSION['error'])) {
            echo "<script>
                Swal.fire({
                    title: 'Fehler!',
                    text: '" . addslashes($_SESSION['error']) . "',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    background: '#333',
                    color: 'white',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                });
            </script>";
            unset($_SESSION['error']);
        } elseif (!empty($_SESSION['success'])) {
            echo "<script>
                Swal.fire({
                    title: 'Erfolg!',
                    text: '" . addslashes($_SESSION['success']) . "',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    background: '#333',
                    color: 'white',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                });
            </script>";
            unset($_SESSION['success']);
        }
                   
        // Benutzer anzeigen
        if (isset($_POST['userid'])) {
            $userId = $_POST['userid'];
            $stmt = $db->prepare("SELECT name, email, status, age FROM users WHERE id = ?");
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                $name =  htmlspecialchars($user['name']);
                $email =  htmlspecialchars($user['email']);
                $age =  $user['age'];
                $status = $user['status'];
                $lastlogin = $_SESSION['last_login'] ?? 'Kein Eintrag';
                if($_SESSION['status'] == 1){
                    $admin = true;
                }else{
                    $admin = false;
                }
                echo "<script>
                    Swal.fire({
                        title: 'Nutzerdetails',
                        html: `
                            <p><strong>Name:  </strong> $name</p>
                            <p><strong>Email:  </strong> $email</p>
                            <p><strong>Alter:  </strong> " . ($age ?? ' Kein Eintrag') ."</p>
                            <p><strong>Status:  </strong> " . ($status == 1 ? 'Administrator' : 'Benutzer') . "</p>
                            <p><strong>Letzte Anmeldung:  </strong> $lastlogin</p>
                        `,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Bearbeiten',
                        cancelButtonText: 'Zurück',
                        background: '#333',
                        color: 'white',
                        confirmButtonColor: 'rgb(0, 119, 255)',
                        cancelButtonColor: 'rgb(0, 119, 255)',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            editUser('$name', '$email', '$age', $status, $userId, $admin);
                        }
                    });
                
                </script>";
            }
        }

        ?>

        <script>
            // Logout Button
            document.getElementById('btn-logout').addEventListener('click', function() {
                window.location.href = 'logout.php';
            });

            //Zum Profil (als Swal Alert)
            document.getElementById('btn-profile').addEventListener('click', function() {
                <?php
                    $userId = $_SESSION['userid'];
                    $stmt = $db->prepare("SELECT name, email, status, age FROM users WHERE id = ?");
                    $stmt->bind_param('i', $userId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $user = $result->fetch_assoc();
                        
                        $name =  htmlspecialchars($user['name']);
                        $email =  htmlspecialchars($user['email']);
                        $age =  $user['age'];
                        $status = $user['status'];
                        $lastlogin = $_SESSION['last_login'] ?? 'Kein Eintrag';

                        if($status == 1){
                            $admin = true;
                        }else{
                            $admin = false;
                        }

                        echo "
                            Swal.fire({
                                title: 'Profil',
                                html: `
                                    <p><strong>Name:  </strong> $name</p>
                                    <p><strong>Email:  </strong> $email</p>
                                    <p><strong>Alter:  </strong> " . ($age ?? ' Kein Eintrag') ."</p>
                                    <p><strong>Status:  </strong> " . ($status == 1 ? 'Administrator' : 'Benutzer') . "</p>
                                    <p><strong>Letzte Anmeldung:  </strong> $lastlogin</p>
                                `,
                                icon: 'info',
                                confirmButtonText: 'Bearbeiten',
                                cancelButtonText: 'Zurück',
                                showCancelButton: true,
                                reverseButtons: true,
                                allowOutsideClick: false,
                                background: '#333',
                                color: 'white',
                                confirmButtonColor: 'rgb(0, 119, 255)',
                                cancelButtonColor: 'rgb(0, 119, 255)',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        editUser('$name', '$email', '$age', $status, $userId, $admin);
                                    }
                                });
                        ";
                    }
                ?>
            });

            // Formularanzeige
            function showForm(formId) {
                const forms = document.querySelectorAll('.form-container');
                forms.forEach(form => form.style.display = 'none');
                document.getElementById(formId).style.display = 'flex';
                sessionStorage.setItem('formId', formId);
            }

            // Beim Laden der Seite das zuletzt angezeigte Formular anzeigen
            window.addEventListener('load', function() {
                const formId = sessionStorage.getItem('formId');
                if (formId) {
                    showForm(formId);
                }
            });

            // Scroll Position speichern und wiederherstellen
            document.addEventListener("DOMContentLoaded", function () {
                const auswahlContainer = document.querySelector('#showtasks');
                const scrollPositionKey = 'auswahlScrollPosition';
                const savedPosition = sessionStorage.getItem(scrollPositionKey);

                if (savedPosition) {
                    auswahlContainer.scrollTop = parseInt(savedPosition, 10);
                }

                auswahlContainer.addEventListener('scroll', () => {
                    sessionStorage.setItem(scrollPositionKey, auswahlContainer.scrollTop);
                });

                document.querySelectorAll('#showtasks button').forEach(button => {
                    button.addEventListener('click', () => {
                        setTimeout(() => {
                            auswahlContainer.scrollTop = parseInt(sessionStorage.getItem(scrollPositionKey), 10);
                        }, 100); 
                    });
                });
            });

            // Funktion Daten änderung in DB hinzuzufügen
            function editUser(name, email, age, status, userid, iscurrentadmin){
                Swal.fire({
                    title: 'Profil bearbeiten',
                    html: `
                        <form id="profileForm">
                            <input type="number" style="width:30vh; padding:1vh 2vh; border:3px solid #333; text-align:center; background-color: grey;" name="userid" value="${userid}" readonly>
                            <br>
                            <input type="text" style="width:30vh; padding:1vh 2vh; border:3px solid #333; text-align:center;" name="name" class="form-control" placeholder="Vor- und Nachname" value="${name}" required autocomplete="name">
                            <br>
                            <input type="email"  style="width:30vh; padding:1vh 2vh; border:3px solid #333; text-align:center;" name="email" class="form-control" placeholder="E-Mail" value="${email}" required autocomplete="email, username">
                            <br>
                            <input type="number" style="width:30vh; padding:1vh 2vh; border:3px solid #333; text-align:center;"  name="age" class="form-control" placeholder="Alter" value="${age}" required autocomplete="age">
                            <br>
                            <p>Status:</p>
                            <img id="statusImage" alt="Status" src="../images/icons/${status == 1 ? 'admin.png' : 'noadmin.png'}" style="width:4vh; height:4vh; cursor:pointer;" ${status == 1 ? '' : 'readonly'}>
                            <p id="statusText">${status == 1 ? 'Administrator' : 'Benutzer'}</p>
                            <input type="hidden" name="status" id="statusHidden" value="${status == 1 ? '1' : '0'}">
                        </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Speichern',
                    cancelButtonText: 'Abbrechen',
                    confirmButtonColor: 'rgb(0, 119, 255)',
                    cancelButtonColor: 'rgb(0, 119, 255)',
                    background: '#333',
                    color: 'white',
                    
                    didOpen: () => {
                        const statusImage = document.getElementById('statusImage');
                        const statusHidden = document.getElementById('statusHidden');

                        if (iscurrentadmin){
                            statusImage.addEventListener('click', () => {
                                const isAdmin = statusHidden.value === '1';
                                statusHidden.value = isAdmin ? '0' : '1';
                                statusImage.src = isAdmin ? '../images/icons/noadmin.png' : '../images/icons/admin.png';
                                statusImage.alt = isAdmin ? 'Benutzer' : 'Administrator';
                                statusText.textContent = isAdmin ? 'Benutzer' : 'Administrator';
                            });
                        } else {
                            statusImage.style= 'readonly';
                            statusImage.style.cursor = 'not-allowed';
                            statusImage.style.height = '4vh'
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('profileForm');
                        const formData = new FormData(form);
                        fetch('update-profile.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Erfolg!',
                                    text: 'Profil erfolgreich aktualisiert.',
                                    icon: 'success',
                                    background: '#333',
                                    color: 'white',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    toast: true,
                                    position: 'top-end',
                                });
                                window.location.reload();
                            } else {
                                Swal.fire({
                                    title: 'Fehler!',
                                    text: data.error,
                                    icon: 'error',
                                    background: '#333',
                                    color: 'white',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    toast: true,
                                    position: 'top-end',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Fehler!',
                                text: 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.',
                                icon: 'error',
                                background: '#333',
                                color: 'white',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                toast: true,
                                position: 'top-end',
                            });
                        });
                    }
                });
            }

            window.addEventListener('load', function() {
                const Ilovecookies = sessionStorage.getItem('Ilovecookies');
                if (Ilovecookies === null) {
                    window.location.href = 'index.php';
                }
            });
        </script>
    </body>
</html>