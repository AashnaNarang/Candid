<?php

include('db_connection.php');

if(isset($_POST["image_id"]))
{
    $id = $_POST["image_id"];
    $query = "DELETE FROM images WHERE image_id = {$id}";
    $statement = $connect->prepare($query);
    $statement->execute();    
}

?>