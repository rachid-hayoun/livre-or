<?php
session_start();
require_once 'Database.php';

$db = new Database('livreor');
$conn = $db->getConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'];
    $id_user = $_SESSION['user_id'];
    $date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO comment (comment, id_user, date) VALUES (?, ?, ?)");
    $stmt->execute([$comment, $id_user, $date]);

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Profil</h1>
        <a href="profil.php" class="user-button"><?= $_SESSION['login'] ?></a>
    </header>
    <main>
        <h2>Ajouter un commentaire</h2>
        <form action="profil.php" method="post">
            <textarea name="comment" placeholder="Votre commentaire" required></textarea>
            <button type="submit">Poster</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2023 Livre d'Or. Tous droits réservés.</p>
    </footer>
</body>
</html>