<?php
session_start();
require_once 'User.php';

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');

$userClass = new User($db);

$error = '';

// Traitement du formulaire de connexion
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $userClass->login($email, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}

// Traitement du formulaire d'inscription
if (isset($_POST['register'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($userClass->register($login, $email, $password)) {
        $error = "Inscription réussie ! Connectez-vous.";
    } else {
        $error = "Erreur lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'Or - Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Livre d'Or</h1>
    </header>

    <a href="index.php" class="home-button">Retour à l'accueil</a>

    <main>
        <section>
            <h2>Connexion</h2>
            <?php if ($error): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="POST">
                <label for="email">Email :</label>
                <input type="email" name="email" required>
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" required>
                <button type="submit" name="login">Se connecter</button>
            </form>
        </section>

        <section>
            <h2>Inscription</h2>
            <form method="POST">
                <label for="login">Login :</label>
                <input type="text" name="login" required>
                <label for="email">Email :</label>
                <input type="email" name="email" required>
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" required>
                <button type="submit" name="register">S'inscrire</button>
            </form>
        </section>
    </main>
</body>
</html>