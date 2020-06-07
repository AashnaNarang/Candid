<?php  
    include("db_connection.php");
    $query = "SELECT * FROM images ORDER BY image_id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $numRows = $statement->rowCount();
?>