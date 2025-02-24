<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Marché Animalier</title>

 
</head>
<body>

    <header>
        <?php include 'menu.php'?>
    </header>

    <main>
  
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Bienvenue, <b> <?= htmlspecialchars($_SESSION['nom']) ?> </b> <!--(<?= htmlspecialchars($_SESSION['type_utilisateur'])  ?>)--> !</p>
            <p>Type d'utilisateur : <?= htmlspecialchars($_SESSION['type_utilisateur']) ?></p>
            <!-- Affichage de l'interface spécifique à chaque type d'utilisateur -->
            <?php if ($_SESSION['type_utilisateur'] == 'eleveur'): ?>
                <p>Gérez vos animaux, consultez vos commandes, et ajoutez des animaux à la vente.</p>
            <?php elseif ($_SESSION['type_utilisateur'] == 'client'): ?>
                <p>Parcourez les animaux disponibles et effectuez vos achats.</p>
            <?php elseif ($_SESSION['type_utilisateur'] == 'admin_principal' || $_SESSION['type_utilisateur'] == 'admin_secondaire'): ?>
                <p>Accédez à la gestion des utilisateurs, animaux et commandes.</p>
            <?php endif; ?>
        <?php else: ?>
           
        <?php endif; ?>

        <section class="hero">
            <h1>Bienvenue sur le Marché Animalier</h1>
            <p>Le premier marché en ligne dédié aux éleveurs et aux passionnés d’animaux. Trouvez, achetez et vendez en toute simplicité.</p>
            <a href="inscription.php" class="btn">Rejoindre maintenant</a>
        </section>

        <section class="presentation">
            <h2>À propos de nous</h2>
            <p>Notre plateforme met en relation éleveurs professionnels, clients et administrateurs pour assurer une expérience fluide et sécurisée.</p>
           <!-- <img src="" alt="Présentation du Marché Animalier"> -->
        </section>

        <section class="fonctionnalites">
            <h2>Nos fonctionnalités</h2>
            <div class="grid">
                <div class="feature">
                   <!--  <img src="" alt="Éleveurs"> -->
                    <h3>Éleveurs</h3>
                    <p>Ajoutez vos animaux, gérez vos ventes et suivez les commandes.</p>
                </div>
                <div class="feature">
                   <!--  <img src="" alt="Clients"> -->
                    <h3>Clients</h3>
                    <p>Parcourez les annonces, achetez des animaux et suivez vos commandes.</p>
                </div>

            </div>
        </section>

    </main>

</body>
</html>
