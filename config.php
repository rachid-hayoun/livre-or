<?php
$host = 'localhost';
$dbname = 'livreor';
$username = 'root'; // Remplace par ton utilisateur MySQL
$password = ''; // Remplace par ton mot de passe MySQL

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>