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


    public function viewBook($genre="", $search="") {
        $sql = "SELECT * FROM book WHERE title LIKE CONCAT('%', :search, '%')";
        
        if(!empty($genre)) { 
            $sql .= " AND genre = :genre";
        }

        $sql .= "ORDER BY title ASC"; // ORDER the books

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":search", $search);

        if(!empty($genre)) { // bind genre
            $query->bindParam(":genre", $genre);
        }
        if($query->execute()){
            return $query->fetchAll();
        }else{
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

        return $record["total"] > 0;
    }

    public function fetchBook($b_id) {
        $sql = "SELECT * FROM book WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":id", $b_id);

        if ($query->execute()) {
            return $query->fetch();
        } else {
            return null;
        }
    }

    public function editBook($b_id) {
        $sql = "UPDATE book 
                SET title = :title, author = :author, genre = :genre, pub_year = :pub_year
                WHERE id = :id";

        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":pub_year", $this->pub_year);
        
        $query->bindParam(":id", $b_id);
 
        return $query->execute();
    }

   public function deleteBook($b_id) {
    $sql = "DELETE FROM book WHERE id = :id";
    $query = $this->db->connect()->prepare($sql);
    $query->bindParam(":id", $b_id);

    return $query->execute();
}

}
