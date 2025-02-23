<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Marché Animalier</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            padding: 10px 0;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .hero {
            background-image: url('');
            background-size: cover;
            background-position: center;
            color: black;
            text-align: center;
            padding: 100px 20px;
        }
        .hero h1 {
            font-size: 3em;
            margin: 0;
        }
        .hero p {
            font-size: 1.2em;
            margin: 20px 0;
        }
        .btn {
            background-color: #FF9800;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
        .presentation, .fonctionnalites {
            padding: 50px 20px;
            text-align: center;
        }
        .presentation img, .fonctionnalites img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .feature {
            flex: 1;
            margin: 20px;
            min-width: 250px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>

 
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li><a href="connexion.php">Se connecter</a></li>
                    <li><a href="inscription.php">S'inscrire</a></li>
                <?php else: ?>
                    <li><a href="dashboard.php">Mon Tableau de Bord</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                <?php endif; ?>
                <li><a href="animaux.php">Animaux disponibles</a></li>
            </ul>
        </nav>
    </header>

    <main>
  
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?> (<?= htmlspecialchars($_SESSION['type_utilisateur']) ?>) !</p>
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
