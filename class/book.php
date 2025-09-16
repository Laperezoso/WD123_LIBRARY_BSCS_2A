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

    public function viewBook(){
        $sql = "SELECT * FROM book ORDER BY title ASC";
        $query = $this->db->connect()->prepare($sql);

        if($query->execute()){
            return $query->fetchAll();
        } else {
            return null;
        }
    }
}
?>
