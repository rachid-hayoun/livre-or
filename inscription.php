<?php
session_start();
include 'database.php';

if (isset($_POST['inscription'])) {
    $login = $_POST['login'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO utilisateurs (login, mot_de_passe, email) VALUES (?, ?, ?)");
    $stmt->execute([$login, $mot_de_passe, $email]);

    echo "Inscription réussie. Vous pouvez vous connecter.";
}

if (isset($_POST['connexion'])) {
    $login = $_POST['login'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $stmt->execute([$login]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['user_id'] = $utilisateur['id'];
        echo "Connexion réussie ! Bienvenue, " . $utilisateur['login'];
    } else {
        echo "Identifiants incorrects.";
    }
}
?>