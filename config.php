<?php

    // Informations de connexion à la base de données

    $host = 'localhost';  // Adresse du serveur (en général, localhost)

    $dbname = 'marche_animalier';  // Nom de la base de données

    $username = 'root';  // Ton nom d'utilisateur de la base

    $password = '';  // Ton mot de passe de la base

    // $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    // Créer une connexion PDO

    try {

        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

        // Définir le mode de récupération d'erreurs

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

        die("Erreur de connexion : " . $e->getMessage());

    }

?>