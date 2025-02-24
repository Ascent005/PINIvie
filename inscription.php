<?php
    
  
    require 'config.php';

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
        $type_utilisateur = $_POST['type_utilisateur'];

        // Vérifier si l'email existe déjà dans la base de données
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $email_exists = $stmt->fetchColumn();

        if ($email_exists > 0) {
            $message = "Cet email est déjà utilisé. Veuillez en choisir un autre.";
        } else {
            // Si l'email n'existe pas, procéder à l'insertion
            $sql = "INSERT INTO users (nom, email, telephone, adresse, mot_de_passe, type_utilisateur) 
                    VALUES (:nom, :email, :telephone, :adresse, :mot_de_passe, :type_utilisateur)";

            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([
                'nom' => $nom,
                'email' => $email,
                'telephone' => $telephone,
                'adresse' => $adresse,
                'mot_de_passe' => $mot_de_passe,
                'type_utilisateur' => $type_utilisateur
            ])) {
                $message = "Inscription réussie ! <a href='connexion.php'>Connectez-vous ici</a>";
            } else {
                $message = "Erreur lors de l'inscription.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <header>
        <?php include 'menu.php'?>
    </header>
    <div class="form">
        <h2>Inscription</h2>
        <form method="post">
            <input type="text" name="nom" placeholder="Nom complet" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="telephone" placeholder="Téléphone" required><br>
            <input type="text" name="adresse" placeholder="Adresse" required><br>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>
            <select name="type_utilisateur">
                <option value="eleveur">Éleveur</option>
                <option value="client">Client (Vendeur/Boucher)</option>
            </select><br>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
    
    <p><?= $message ?></p>
</body>
</html>