<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <li><a href="connexion.php">Se connecter</a></li>
            <li><a href="inscription.php">S'inscrire</a></li>
            <li><a href="animaux.php">Animaux disponibles</a></li>
        <?php else: ?>
            <?php if ($_SESSION['type_utilisateur'] == 'eleveur'): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="ajout_animal.php">Ajouter un animal</a></li>
                <li><a href="commandes.php">Commandes</a></li>
                <li><a href="carnet_soins.php">Carnet de soins</a></li>
            <?php elseif ($_SESSION['type_utilisateur'] == 'client'): ?>
                <li><a href="animaux.php">Animaux disponibles</a></li>
                <li><a href="commandes.php">Mes commandes</a></li>
            <?php elseif ($_SESSION['type_utilisateur'] == 'admin_principal' || $_SESSION['type_utilisateur'] == 'admin_secondaire'): ?>
                <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
            <?php endif; ?>
            <li><a href="profil.php">Mon Profil</a></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        <?php endif; ?>
    </ul>
</nav>
