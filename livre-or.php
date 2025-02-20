<?php
// Configurer le fuseau horaire
date_default_timezone_set('Europe/Paris'); // Remplacez par votre fuseau horaire

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

// Traitement de la suppression d'un commentaire
if ($isLoggedIn && isset($_GET['delete'])) {
    $id_comment = (int)$_GET['delete'];
    if ($commentClass->deleteComment($id_comment, $user['id'])) {
        header('Location: livre-or.php'); // Recharger la page après suppression
        exit();
    } else {
        echo "<p style='color: red;'>Erreur : Vous ne pouvez pas supprimer ce commentaire.</p>";
    }
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$comments = $commentClass->getAllComments($page, $perPage);

// Recherche
$searchResults = [];
if (isset($_GET['search'])) {
    $searchResults = $commentClass->searchComments($_GET['search']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or - Commentaires</title>
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
            <h2>Commentaires</h2>
            <form method="GET" action="livre-or.php">
                <input type="text" name="search" placeholder="Rechercher un commentaire...">
                <button type="submit">Rechercher</button>
            </form>

            <?php if (!empty($searchResults)): ?>
                <h3>Résultats de la recherche :</h3>
                <?php foreach ($searchResults as $comment): ?>
                    <div class="comment">
                        <p><strong><?= htmlspecialchars($comment['login']) ?></strong> a écrit le <?php
                            $date = new DateTime($comment['date']);
                            echo $date->format('d/m/Y H:i');
                        ?> :</p>
                        <p><?= htmlspecialchars($comment['comment']) ?></p>
                        <?php if ($isLoggedIn && $comment['id_user'] === $user['id']): ?>
                            <a href="livre-or.php?delete=<?= $comment['id'] ?>" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p><strong><?= htmlspecialchars($comment['login']) ?></strong> a écrit le <?php
                            $date = new DateTime($comment['date']);
                            echo $date->format('d/m/Y H:i');
                        ?> :</p>
                        <p><?= htmlspecialchars($comment['comment']) ?></p>
                        <?php if ($isLoggedIn && $comment['id_user'] === $user['id']): ?>
                            <a href="livre-or.php?delete=<?= $comment['id'] ?>" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <!-- Pagination -->
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="livre-or.php?page=<?= $page - 1 ?>">Précédent</a>
                    <?php endif; ?>
                    <span>Page <?= $page ?></span>
                    <a href="livre-or.php?page=<?= $page + 1 ?>">Suivant</a>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>