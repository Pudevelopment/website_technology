<?php 
require_once "config.php";
session_start();
//require_once "session.php";

$error = ''; // Initialize the $error variable
$success = ''; // Initialize the $success variable

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

    $h1name = trim($_POST['h1name']);
    $name = trim($_POST['name']);
    $typ = trim($_POST['typ']);
    $typ_db = trim($_POST['typ_db']);
    $hersteller = trim($_POST['hersteller']);
    $nennspannung = !empty($_POST['nennspannung']) ? trim($_POST['nennspannung']) : NULL;
    $betriebstemp = !empty($_POST['betriebstemp']) ? trim($_POST['betriebstemp']) : NULL;
    $drehzahl = !empty($_POST['drehzahl']) ? trim($_POST['drehzahl']) : NULL;
    $schwenkung = !empty($_POST['schwenkung']) ? trim($_POST['schwenkung']) : NULL;
    $horizontaledrehung = !empty($_POST['horizontaledrehung']) ? trim($_POST['horizontaledrehung']) : NULL;
    $turbinenneigung = !empty($_POST['turbinenneigung']) ? trim($_POST['turbinenneigung']) : NULL;
    $wasserdruck = !empty($_POST['wasserdruck']) ? trim($_POST['wasserdruck']) : NULL;
    $nennleistung = !empty($_POST['nennleistung']) ? trim($_POST['nennleistung']) : NULL;  
    $bildpfad = !empty($_POST['bildpfad']) ? trim($_POST['bildpfad']): NULL;
    $besonderheiten = !empty($_POST['besonderheiten']) ? trim($_POST['besonderheiten']): NULL;

    if($query = $db->prepare("SELECT * FROM beschneiungsanlagendaten WHERE h1name = ?")){
        $query->bind_param('s', $h1name);
        $query->execute();
        $query->store_result();
        if($query->num_rows > 0){
            $error .= 'Diese Beschneiungsanlage ist schon vorhanden! Wenden Sie sich an einen Administrator zum bearbeiten der Daten';
        } else {
            if(empty($typ_db)){
                $error .= 'Bitte wählen sie einen Seilbahntyp aus.';
            }
            if(empty($error)){
                $insertQuery = $db->prepare("INSERT INTO beschneiungsanlagendaten (typ_db, name, h1name, Baujahr, Typ, Standort, Hersteller, Nennspannung, Betriebstemp, Drehzahl, Schwenkung, Horizontaledrehung, Turbinenneigung, Wasserdruck, Nennleistung, Bildpfad, Besonderheiten) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $insertQuery->bind_param("sssssssssssssssss", $typ_db, $name, $h1name, $baujahr, $typ, $standort, $hersteller, $nennspannung, $betriebstemp, $drehzahl, $schwenkung, $horizontaledrehung, $turbinenneigung, $wasserdruck, $nennleistung, $bildpfad, $besonderheiten);
                $result = $insertQuery->execute();
                if($result){
                    $success = 'Sie haben die Beschneiungsanlage erfolgreich hinzugefügt!';
                    };
                } else {
                    $error .= 'Es ist ein Fehler aufgetreten!';
                }
            }
        }else {
            $error .= 'Datenbankabfrage fehlgeschlagen.';
        }
        $_SESSION['success'] = $success;
        $_SESSION['error'] = $error;
        header("Location: Mainsite.php");
        $query->close();
    }
    if (isset($insertQuery)) {
        $insertQuery->close();
    }
?>