<?php
require_once "../class/book.php";
$bookObj = new Book();

$search = "";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $search = isset($_GET["search"])? trim(htmlspecialchars($_GET["search"])) : "";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Books</title>
</head>
<body>
    <h1>List of Books</h1>
     <form action="" method="get">
        <label for="">Search:</label>
        <input type="search" name="search" id="search" value="<?= $search ?>">
        <input type="submit" value="Search">
    </form>
    <button><a href="addbook.php"> Add New Book</a></button>
    <br><br>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Book Name</th>
            <th>Author</th>
            <th>Publication Year</th>
            <th>Genre</th>
        </tr>
        <?php
        $no = 1;

        foreach($bookObj->viewBook($search) as $book){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $book["title"] ?></td>
            <td><?= $book["author"] ?></td>
             <td><?= $book["genre"] ?></td>
             <td><?= $book["pub_year"] ?></td>
        </tr>
        <?php
        }
       /* $books = $bookObj->viewBook();
        if($books){
            foreach($books as $book){ ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $book["title"] ?></td>
                    <td><?= $book["author"] ?></td>
                    <td><?= $book["pub_year"] ?></td>
                    <td><?= $book["genre"] ?></td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='5'>No books found</td></tr>";
        }*/
        ?>
    </table>
</body>
</html>
