<?php

include('db_connection.php');

if(isset($_POST["image_id"]))
{
    file_put_contents("logs.txt", "made it");
    $query = "
        UPDATE images 
        SET name = '".$_POST["name"]."', description = '".$_POST["description"]."' 
        WHERE image_id = '".$_POST["image_id"]."'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
}

?>