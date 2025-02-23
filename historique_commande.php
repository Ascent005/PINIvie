<?php
session_start();
require 'config.php';

// Vérifier si l'utilisateur est connecté et est un acheteur
if (!isset($_SESSION['user_id']) || $_SESSION['type_utilisateur'] !== 'client') {
    header("Location: connexion.php");
    exit();
}

$client_id = $_SESSION['user_id'];

// Récupérer les commandes du client
$sql = "SELECT animaux.type, animaux.race, commandes.date_commande, commandes.statut, commandes.prix
        FROM commandes
        JOIN animaux ON commandes.animal_id = animaux.id
        WHERE commandes.client_id = :client_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['client_id' => $client_id]);
$commandes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Commandes</title>
</head>
<body>
    <h1>Historique des Commandes</h1>
    <table border="1">
        <tr>
            <th>Animal</th>
            <th>Prix</th>
            <th>Date de Commande</th>
