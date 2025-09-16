<?php
require_once "../class/book.php";
$bookObj = new Book();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Books</title>
</head>
<body>
    <h1>List of Books</h1>
    <a href="addbook.php"> Add New Book</a>
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
        $books = $bookObj->viewBook();
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
        }
        ?>
    </table>
</body>
</html>
