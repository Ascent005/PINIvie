<?php
session_start();
require 'config.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur depuis la table utilisateurs (ou users selon ta base)
$sql = "SELECT * FROM utilisateurs WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <?php include 'menu.php'; ?>
    </header>
    <main>
        <h2>Mon Profil</h2>
        <?php if($user): ?>
            <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Type :</strong> <?= htmlspecialchars($user['type_utilisateur']) ?></p>
            <!-- Vous pouvez ajouter un formulaire pour modifier ces informations si besoin -->
        <?php else: ?>
            <p>Aucun profil trouvé.</p>
        <?php endif; ?>
    </main>
</body>
</html>
