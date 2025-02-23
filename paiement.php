<?php
    include 'menu.php';

    session_start();
    require 'config.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: connexion.php");
        exit();
    }

    $message = "Le paiement en ligne sera bientôt disponible. Pour l’instant, les transactions se font en espèces à la livraison.";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Paiement en ligne</h2>
    <p><?= $message ?></p>
</body>
</html>