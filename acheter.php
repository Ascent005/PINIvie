<?php
    include 'menu.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'config.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['type_utilisateur'] !== 'client') {
        header("Location: connexion.php");
        exit();
    }

    if (!isset($_GET['id'])) {
        die("Animal non trouvé.");
    }

    $id_animal = $_GET['id'];
    $id_client = $_SESSION['user_id'];

    $sql = "INSERT INTO commandes (id_client, id_animal, date_commande, statut) 
    VALUES (:id_client, :id_animal, NOW(), 'en attente')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
    'id_client' => $id_client,
    'id_animal' => $id_animal
    ]);

    if ($stmt->execute(['id-client' => $id_client, 'id_animal' => $id_animal])) {
        echo "Commande passée avec succès !";
    } else {
        echo "Erreur lors de la commande.";
    }
?>
