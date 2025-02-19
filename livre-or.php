<?php
include 'database.php';

$limite = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limite;

$stmt = $pdo->prepare("SELECT * FROM commentaires ORDER BY date_publication DESC LIMIT ? OFFSET ?");
$stmt->execute([$limite, $offset]);
$commentaires = $stmt->fetchAll();

foreach ($commentaires as $commentaire) {
    echo "<p>" . $commentaire['texte'] . " - Posté le " . $commentaire['date_publication'] . "</p>";
}

$stmt = $pdo->prepare("SELECT COUNT(*) FROM commentaires");
$stmt->execute();
$total_commentaires = $stmt->fetchColumn();
$nombre_pages = ceil($total_commentaires / $limite);

for ($i = 1; $i <= $nombre_pages; $i++) {
    echo "<a href='livre-or.php?page=$i'>$i</a> ";
}
?>