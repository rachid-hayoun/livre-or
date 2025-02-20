-- Création de la base de données
CREATE DATABASE IF NOT EXISTS livreor;
USE livreor;

-- Table `user` pour les utilisateurs
CREATE TABLE IF NOT EXISTS user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(255) NOT NULL,
    email VARCHAR(191) NOT NULL UNIQUE, -- Taille réduite à 191 pour éviter l'erreur de clé trop longue
    password VARCHAR(255) NOT NULL
);

-- Table `comment` pour les commentaires
CREATE TABLE IF NOT EXISTS comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    comment TEXT NOT NULL,
    id_user INT NOT NULL,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES user(id)
);