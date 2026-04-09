<?php


class Article{
    private $conn;


    public function __construct($db){
         $this->conn = $db;
    }


    public function all(){
        $query = "select * from posts";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function create($title, $content, $id_user, $publish_date) {
        $query = "insert into posts (title, content, id_user, publish_date) values (:title, :content, :id_user, :publish_date)";
        $stmt  = $this->conn->prepare($query);
        return $stmt->execute([
            ':title'   => $title,
            ':content'   => $content,
            ':id_user'   => $id_user,
            ':publish_date'   => $publish_date
        ]);
    }
}