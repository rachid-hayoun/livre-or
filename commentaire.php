<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['commentaire'])) {
    $texte = $_POST['texte'];
    $utilisateur_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO commentaires (texte, utilisateur_id) VALUES (?, ?)");
    $stmt->execute([$texte, $utilisateur_id]);
    echo "Commentaire ajouté avec succès.";
}
?>

<form method="post">
    <textarea name="texte" required></textarea>
    <button type="submit" name="commentaire">Ajouter</button>
</form>