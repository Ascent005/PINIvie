<?php
    session_start();
    require 'config.php';

    // Vérification si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header("Location: connexion.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $type_utilisateur = $_SESSION['type_utilisateur'];

    // Vérifier si l'utilisateur est un client, sinon rediriger
    if ($type_utilisateur != 'client') {
        header("Location: index.php");
        exit();
    }

    // Récupérer les animaux disponibles à la vente
    $sql = "SELECT * FROM animaux WHERE statut = 'disponible'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $animaux = $stmt->fetchAll();

    // Traitement du formulaire de commande
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_animal = $_POST['animal_id'];

        // Insérer la commande dans la base de données

        $sql = "INSERT INTO commandes (id_client, id_animal, date_commande, statut) 
        VALUES (:id_client, :id_animal, NOW(), 'en attente')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
        'id_client' => $id_client,
        'id_animal' => $id_animal
        ]);
    
        $message = "Votre commande a été passée avec succès !";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Passer une Commande - Marché Animalier</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="user-badge">
        <span><?= htmlspecialchars($_SESSION['type_utilisateur']) ?></span>
    </div>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="dashboard.php">Mon Tableau de Bord</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <div class="user-badge">
        <span><?= htmlspecialchars($_SESSION['type_utilisateur']) ?></span>
    </div>

    <main>
        <h1>Passer une Commande</h1>

        <?php if (isset($message)): ?>
            <p class="success-message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <h2>Animaux Disponibles</h2>
        <form method="POST">
            <select name="animal_id" required>
                <option value="">Sélectionnez un animal</option>
                <?php foreach ($animaux as $animal): ?>
                    <option value="<?= $animal['id'] ?>"><?= htmlspecialchars($animal['type']) . " - " . htmlspecialchars($animal['race']) ?></option>
                <?php endforeach; ?>
            </select><br>

            <button type="submit" class="btn">Passer la commande</button>
        </form>
    </main>

</body>
</html>
