<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Inscription d'un utilisateur
    public function register($login, $email, $password) {
        $query = $this->db->prepare("INSERT INTO user (login, email, password) VALUES (:login, :email, :password)");
        $query->execute([
            'login' => $login,
            'email' => $email,
            'password' => $password
        ]);
        return $this->db->lastInsertId();
    }

    // Connexion d'un utilisateur
    public function login($email, $password) {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
        $query->execute([
            'email' => $email,
            'password' => $password
        ]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($id) {
        $query = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Modifier le login d'un utilisateur
    public function updateLogin($id, $newLogin) {
        $query = $this->db->prepare("UPDATE user SET login = :login WHERE id = :id");
        $query->execute([
            'login' => $newLogin,
            'id' => $id
        ]);
    }

    // Modifier le mot de passe d'un utilisateur
    public function updatePassword($id, $newPassword) {
        $query = $this->db->prepare("UPDATE user SET password = :password WHERE id = :id");
        $query->execute([
            'password' => $newPassword,
            'id' => $id
        ]);
    }
}
?>