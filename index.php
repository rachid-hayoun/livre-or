<?php
session_start();
require_once 'User.php';
require_once 'Comment.php';

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

$userClass = new User($db);
$commentClass = new Comment($db);

// Vérifier si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['user_id']);
$user = $isLoggedIn ? $userClass->getUserById($_SESSION['user_id']) : null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Livre d'Or</h1>
        <?php if ($isLoggedIn): ?>
            <p>Bienvenue, <?= htmlspecialchars($user['login']) ?> ! <a href="logout.php">Déconnexion</a></p>
        <?php else: ?>
            <p><a href="connexion.php">Connexion</a> | <a href="connexion.php">Inscription</a></p>
        <?php endif; ?>
    </header>

    <a href="index.php" class="home-button">Retour à l'accueil</a>

    <main>
        <section>
            <h2>Bienvenue sur le Livre d'Or</h2>
            <p>Laissez un commentaire ou consultez ceux des autres utilisateurs.</p>
            <?php if ($isLoggedIn): ?>
                <a href="commentaire.php" class="custom-button">Ajouter un commentaire</a>
            <?php endif; ?>
            <a href="livre-or.php" class="custom-button">Voir les commentaires</a>
        </section>
    </main>
</body>
</html>