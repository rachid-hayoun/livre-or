<?php
include 'database.php';

if (isset($_POST['recherche'])) {
    $mots_cles = $_POST['mots_cles'];
    $stmt = $pdo->prepare("SELECT * FROM commentaires WHERE texte LIKE ?");
    $stmt->execute(['%' . $mots_cles . '%']);
    $commentaires = $stmt->fetchAll();

    foreach ($commentaires as $commentaire) {
        echo "<p>" . $commentaire['texte'] . " - Posté le " . $commentaire['date_publication'] . "</p>";
    }
}
?>

<form method="post">
    <input type="text" name="mots_cles" required>
    <button type="submit" name="recherche">Rechercher</button>
</form>