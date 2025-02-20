<?php
class Database {
    private $conn;

    public function __construct($dbname) {
        $host = 'localhost';
        $username = 'root'; // Remplace par ton utilisateur MySQL
        $password = ''; // Remplace par ton mot de passe MySQL

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>