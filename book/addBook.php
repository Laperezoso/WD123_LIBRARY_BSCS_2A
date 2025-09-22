<?php
require_once "../class/book.php";
$bookObj = new Book();

$book = ["title"=>"", "author"=>"", "genre"=>"", "pub_year"=>""];
$errors = ["title"=>"", "author"=>"", "genre"=>"", "pub_year"=>""];

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $book["title"] = trim(htmlspecialchars($_POST["title"]));
    $book["author"] = trim(htmlspecialchars($_POST["author"]));
    $book["genre"] = trim(htmlspecialchars($_POST["genre"]));
    $book["pub_year"] = trim(htmlspecialchars($_POST["pub_year"]));

   
    if(empty($book["title"])){
        $errors["title"] = "Title is required";
    }elseif($bookObj->isBookExist($book["title"])){
        $errors["title"] = "title name already exist";
    }
    if(empty($book["author"])){
        $errors["author"] = "Author is required";
    }
    if(empty($book["genre"])){
        $errors["genre"] = "Genre is required";
    }
    if(empty($book["pub_year"]) || $book["pub_year"] > 2025){
        $errors["pub_year"] = "Publication year is not valid";
    } elseif(!is_numeric($book["pub_year"])){
        $errors["pub_year"] = "Number only";
    }

    
    if(empty(array_filter($errors))){
        $bookObj->title = $book["title"];
        $bookObj->author = $book["author"];
        $bookObj->genre = $book["genre"];
        $bookObj->pub_year = $book["pub_year"];

        if($bookObj->addBook()){
            
            header("Location: viewbook.php");
            exit;
        } else {
            echo "Failed to add book!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        label { display: block; margin-top: 10px; }
        span.error { color: red; font-size: 12px; }
    </style>
</head>
<body>
    <h1>Add Book</h1>
    <form action="" method="post">
        <label>Book Name *</label>
        <input type="text" name="title" value="<?= $book['title'] ?>">
        <span class="error"><?= $errors["title"] ?></span>

        <label>Book Author *</label>
        <input type="text" name="author" value="<?= $book['author'] ?>">
        <span class="error"><?= $errors["author"] ?></span>

        <label>Publication Year *</label>
        <input type="text" name="pub_year" value="<?= $book['pub_year'] ?>">
        <span class="error"><?= $errors["pub_year"] ?></span>

        <label>Genre *</label>
        <select name="genre">
            <option value="">-- Select Genre --</option>
            <option value="history" <?= ($book["genre"]=="history") ? "selected" : "" ?>>History</option>
            <option value="science" <?= ($book["genre"]=="science") ? "selected" : "" ?>>Science</option>
            <option value="fiction" <?= ($book["genre"]=="fiction") ? "selected" : "" ?>>Fiction</option>
        </select>
        <span class="error"><?= $errors["genre"] ?></span>

        <br><br>
        <input type="submit" value="Save Book">
    </form>

</body>
</html>
