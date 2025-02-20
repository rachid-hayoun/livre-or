<?php
session_start();
require_once 'Database.php';

$db = new Database('livreor');
$conn = $db->getConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Livre d'Or</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Admin</h1>
        <a href="admin.php?logout" class="user-button">Déconnexion</a>
    </header>
    <main>
        <h2>Bienvenue, <?= $_SESSION['login'] ?> !</h2>
        <div class="admin-buttons">
            <a href="profil.php" class="button">Profil</a>
            <a href="admin.php?logout" class="button">Déconnexion</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Livre d'Or. Tous droits réservés.</p>
    </footer>
</body>
</html>