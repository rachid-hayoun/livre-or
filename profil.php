<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['modifier'])) {
    $new_login = $_POST['login'];
    $new_mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("UPDATE utilisateurs SET login = ?, mot_de_passe = ? WHERE id = ?");
    $stmt->execute([$new_login, $new_mot_de_passe, $_SESSION['user_id']]);
    echo "Profil mis à jour avec succès.";
}

$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$utilisateur = $stmt->fetch();
?>

<form method="post">
    <label for="login">Login :</label>
    <input type="text" name="login" value="<?= $utilisateur['login'] ?>" required>
    
    <label for="mot_de_passe">Mot de passe :</label>
    <input type="password" name="mot_de_passe" required>
    
    <button type="submit" name="modifier">Modifier</button>
</form>