<?php
    session_start();
    require 'config.php';

    // Vérification de l'utilisateur connecté et de son rôle
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['type_utilisateur'])) {
        header("Location: connexion.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $type_utilisateur = $_SESSION['type_utilisateur']; // 'admin_principal' ou 'admin_secondaire'

    // Si c'est un admin principal, on récupère toutes les informations.
    if ($type_utilisateur == 'admin_principal') {
        $sql_users = "SELECT id, nom, email, type_utilisateur FROM utilisateurs";
        $stmt_users = $pdo->prepare($sql_users);
        $stmt_users->execute();
        $users = $stmt_users->fetchAll();

        // Les stats ou autres informations globales pour l'admin principal
        $sql_animaux = "SELECT COUNT(*) AS total_animaux FROM animaux";
        $stmt_animaux = $pdo->prepare($sql_animaux);
        $stmt_animaux->execute();
        $total_animaux = $stmt_animaux->fetchColumn();

        $sql_commandes = "SELECT COUNT(*) AS total_commandes FROM commandes";
        $stmt_commandes = $pdo->prepare($sql_commandes);
        $stmt_commandes->execute();
        $total_commandes = $stmt_commandes->fetchColumn();
        
    } else if ($type_utilisateur == 'admin_secondaire') {
        // L'admin secondaire n'a pas les mêmes accès
        // Par exemple, on ne lui permet pas de voir tous les utilisateurs
        $sql_animaux = "SELECT COUNT(*) AS total_animaux FROM animaux";
        $stmt_animaux = $pdo->prepare($sql_animaux);
        $stmt_animaux->execute();
        $total_animaux = $stmt_animaux->fetchColumn();

        $sql_commandes = "SELECT COUNT(*) AS total_commandes FROM commandes";
        $stmt_commandes = $pdo->prepare($sql_commandes);
        $stmt_commandes->execute();
        $total_commandes = $stmt_commandes->fetchColumn();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <?php include 'menu.php' ; ?>
    </header>
    <h2>Bienvenue dans le Tableau de Bord</h2>
    
    <?php if ($type_utilisateur == 'admin_principal'): ?>
        <h3>Vue d'Ensemble pour l'Admin Principal</h3>
        <p><strong>Total des Animaux en Vente : </strong><?= $total_animaux ?></p>
        <p><strong>Total des Commandes : </strong><?= $total_commandes ?></p>

        <h4>Liste des Utilisateurs</h4>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Type d'Utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['type_utilisateur']) ?></td>
                        <td>
                            <a href="modifier_utilisateur.php?id=<?= $user['id'] ?>">Modifier</a> | 
                            <a href="supprimer_utilisateur.php?id=<?= $user['id'] ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Gérer la plateforme</h4>
        <p><a href="gestion_platform.php">Accéder aux paramètres de la plateforme</a></p>

    <?php elseif ($type_utilisateur == 'admin_secondaire'): ?>
        <h3>Vue d'Ensemble pour l'Admin Secondaire</h3>
        <p><strong>Total des Animaux en Vente : </strong><?= $total_animaux ?></p>
        <p><strong>Total des Commandes : </strong><?= $total_commandes ?></p>

        <h4>Gérer les Animaux et Commandes</h4>
        <p><a href="gestion_animaux.php">Gérer les Animaux</a></p>
        <p><a href="gestion_commandes.php">Gérer les Commandes</a></p>

    <?php endif; ?>

</body>
</html>
