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
    $lgeraet = !empty($_POST['lgeraet']) ? trim($_POST['lgeraet']) : NULL;
    $bgeraet = !empty($_POST['bgeraet']) ? trim($_POST['bgeraet']) : NULL;
    $hgeraet = !empty($_POST['hgeraet']) ? trim($_POST['hgeraet']) : NULL;
    $gewicht = !empty($_POST['gewicht']) ? trim($_POST['gewicht']) : NULL;
    $leistung = !empty($_POST['leistung']) ? trim($_POST['leistung']) : NULL;
    $zugkraft = !empty($_POST['zugkraft']) ? trim($_POST['zugkraft']) : NULL;
    $geschwindigkeit = !empty($_POST['geschwindigkeit']) ? trim($_POST['geschwindigkeit']) : NULL;
    $winde = isset($_POST['Winde']) ? intval($_POST['Winde']) : 0;    
    $bildpfad = !empty($_POST['bildpfad']) ? trim($_POST['bildpfad']): NULL;
    $besonderheiten = !empty($_POST['besonderheiten']) ? trim($_POST['besonderheiten']): NULL;

    if($query = $db->prepare("SELECT * FROM pistengeraetedaten WHERE h1name = ?")){
        $query->bind_param('s', $h1name);
        $query->execute();
        $query->store_result();
        if($query->num_rows > 0){
            $error .= 'Dieses Gerät ist schon vorhanden! Wenden Sie sich an einen Administrator zum bearbeiten der Daten';
        } else {
            if(empty($typ_db)){
                $error .= 'Bitte wählen sie einen Seilbahntyp aus.';
            }
            if(empty($error)){
                $insertQuery = $db->prepare("INSERT INTO pistengeraetedaten (typ_db, name, h1name, Baujahr, Typ, Standort, Hersteller, LGerät, BGerät, HGerät, Gewicht, Leistung, Zugkraft, Geschwindigkeit, Winde, Bildpfad, Besonderheiten) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $insertQuery->bind_param("sssssssssssssssss", $typ_db, $name, $h1name, $baujahr, $typ, $standort, $hersteller, $lgeraet, $bgeraet, $hgeraet, $gewicht, $leistung, $zugkraft, $geschwindigkeit, $winde, $bildpfad, $besonderheiten);
                $result = $insertQuery->execute();
                if($result){
                    $success = 'Sie haben das Pistengerät erfolgreich hinzugefügt!';
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