<?php
// Weiterleitung zu homepage.php
$target = 'seilbahnen.php';

if (!headers_sent()) {
    header('Location: ' . $target, true, 302);
    exit;
}
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="0;url=<?php echo htmlspecialchars($target, ENT_QUOTES, 'UTF-8'); ?>">
    <title>Weiterleitung...</title>
</head>
<body>
    <p>Weiterleitung zu <a href="<?php echo htmlspecialchars($target, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($target); ?></a></p>
</body>
</html>