<?php
session_start();
require_once 'User.php';
require_once 'Comment.php';

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

$userClass = new User($db);
$commentClass = new Comment($db);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

$user = $userClass->getUserById($_SESSION['user_id']);

// Traitement du formulaire de commentaire
if (isset($_POST['submit'])) {
    $comment = $_POST['comment'];
    $commentClass->addComment($comment, $user['id']);
    header('Location: livre-or.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or - Ajouter un commentaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Livre d'Or</h1>
        <p>Bienvenue, <?= htmlspecialchars($user['login']) ?> ! <a href="logout.php">Déconnexion</a></p>
    </header>

    <a href="index.php" class="home-button">Retour à l'accueil</a>

    <main>
        <section>
            <h2>Ajouter un commentaire</h2>
            <form method="POST">
                <textarea name="comment" placeholder="Votre commentaire..." required></textarea>
                <button type="submit" name="submit">Poster</button>
            </form>
        </section>
    </main>
</body>
</html>