<?php
class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Ajouter un commentaire
    public function addComment($comment, $id_user) {
        $query = $this->db->prepare("INSERT INTO comment (comment, id_user) VALUES (:comment, :id_user)");
        $query->execute([
            'comment' => $comment,
            'id_user' => $id_user
        ]);
        return $this->db->lastInsertId();
    }

    // Récupérer tous les commentaires (avec pagination)
    public function getAllComments($page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        $query = $this->db->prepare("SELECT comment.*, user.login FROM comment JOIN user ON comment.id_user = user.id ORDER BY date DESC LIMIT :offset, :perPage");
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Rechercher des commentaires par mot-clé
    public function searchComments($keyword) {
        $query = $this->db->prepare("SELECT comment.*, user.login FROM comment JOIN user ON comment.id_user = user.id WHERE comment LIKE :keyword ORDER BY date DESC");
        $query->execute(['keyword' => "%$keyword%"]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Supprimer un commentaire
    public function deleteComment($id_comment, $id_user) {
        $query = $this->db->prepare("DELETE FROM comment WHERE id = :id_comment AND id_user = :id_user");
        $query->execute([
            'id_comment' => $id_comment,
            'id_user' => $id_user
        ]);
        return $query->rowCount() > 0; // Retourne true si le commentaire a été supprimé
    }
}
?>