<?php

require_once "database.php";

class Book {
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $pub_year = "";

    protected $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addBook(){
        $sql = "INSERT INTO book (title, author, genre, pub_year) 
                VALUES (:title, :author, :genre, :pub_year)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':title', $this->title);
        $query->bindParam(':author', $this->author);
        $query->bindParam(':genre', $this->genre);
        $query->bindParam(':pub_year', $this->pub_year);

        return $query->execute();
    }

    public function viewBook($search = ""){
        $sql = "SELECT * FROM book WHERE title LIKE CONCAT('%', :search, '%') ORDER BY title ASC";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":search", $search);

        if($query->execute()){
            return $query->fetchAll();
        } else {
            return null;
        }
    }

     public function isBookExist($title){
        $sql = "SELECT COUNT(*) as total FROM book WHERE title = :title";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":title", $title);
        $record = null;
        if ($query->execute()) {
            $record = $query->fetch();
        }

        if($record["total"] > 0){
            return true;
        }else{
            return false;
        }
    }
}
