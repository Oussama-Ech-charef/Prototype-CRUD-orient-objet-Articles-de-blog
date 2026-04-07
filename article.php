<?php


class Article {
    private $conn;


    public function __construct($db) {
        $this->conn = $db;

    }



    public function all() {
        $sql = "select * from posts";
        $stmt= $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function create($title, $content, $publish_date) {
        $sql = "insert into posts (title, content, publish_date)
                    values (:title, :content, :publish_date)";

                    $stmt = $this->conn->prepare($sql);

                    return $stmt->execute([
                        ':title' => $title,
                        ':content' => $content,
                        ':publish_date' => $publish_date
                    ]);
    }
    
}