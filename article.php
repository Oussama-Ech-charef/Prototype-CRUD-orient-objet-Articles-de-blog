<?php 


class Article {
    
    private $conn;


    public function __construct($db) {
        
        $this->conn = $db;

        
    }


    public function all() {

        $sql = "SELECT * FROM posts  ORDER BY publish_date DESC";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function create($title, $content, $id_user, $id_category) {

        $sql = "INSERT INTO  posts (title, content, id_user, id_category) 
                       VALUES (:title, :content, :id_user, :id_category)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([

            ':title'        => $title,
            ':content'      => $content,
            ':id_user'      => $id_user,
            ':id_category'  => $id_category
        ]);

    }
}